<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
$user = array();

if(!empty($_SESSION)){

   foreach ($_SESSION as $key => $value) {
      $user[$key] = $value;      
}

function conecta(){ 
   //CONEXAO OFLLINE
    
   $host = "localhost";
   $usuario = "root";
   $senha = "";
   $banco_dados = "lost_and_found_db";



   try{
   $pdo = new PDO("mysql:host=$host;dbname=$banco_dados","$usuario","$senha");  
   
   }catch (PDOException $erro){
       echo"Erro ao conectar com o banco de dados".$erro->getMessage();
   }
   return $pdo;
}//end Conecta



function redirect($customer_code){
        
   echo"<script language='javascript'> window.location='".$customer_code."/'; </script>";        
    
}/*END redirect*/


function sgc_save_db($tabela, $campos, $id) {
  $fields_up = '';
  $question  = 0;

  foreach ($campos as $field => $value) {
    $fields[] = $field;                 //array somente com os campos
    $fields_up .= $field.' = '.'?, ';  //strnng pronta com os campos para Update 
    $values[] = $value;                 //array somente com os valores
    $question ++;                       //contador para repetir ?, no INSERT   
  }

  if($id == '0' || $id == ''){
        
    $fields_insert   = implode(", ", $fields); //string com os campos para o insert  
    $question = substr(str_repeat('?,', $question),0,-1);//repete a quantidade de interrogação necessária para o insert
    $sql = "INSERT INTO ".$tabela." (".$fields_insert.") VALUES (".$question.")";     


  }else{//fazendo update

    $values[] = $id;
    $sql = "UPDATE ".$tabela." SET ".substr($fields_up,0,-2)." WHERE id = ?";
  }// END ELSE

    $save = conecta()->prepare($sql);
    $save->execute($values);
    $retorno = $save->errorInfo();
    
    if(!$id){
      $query = "SELECT id FROM ".$tabela." ORDER BY id DESC LIMIT 0,1";
      $last = conecta()->prepare($query);
      $last->execute();
      $row = $last->fetch(PDO::FETCH_ASSOC);      
    }

    $ret = array();
    $ret['error_number'] = $retorno[1];
    $ret['error_info'] = $retorno[2];
    $ret['new_id'] = (empty($row['id']))?'0':$row['id'];
return $ret;

 }/*END dave_db*/


 function sgc_delete_db($tabela, $ids, $where = ''){
     
     if(!$where){
         
        $sql = "DELETE FROM ".$tabela." WHERE id IN(".$ids.")";
     }else{
        $sql = "DELETE FROM ".$tabela." WHERE id IN(".$ids.") AND ".$where; 
 
     }

  $del = conecta()->prepare($sql);
  $del->execute();

  return $del->errorInfo();

 }
 
 
 


 function sgc_date_format($var_date,$format){

if($var_date){
$var_date = str_replace("/", "-", $var_date);
$var_date = date($format, strtotime($var_date));
   
return $var_date;
}else{

  return '';
}

 }

 function sgc_limit_string($string,$limit){

    $string = strip_tags($string);
    $limit  = substr($string, 0, $limit);
    $pos    = strrpos($limit, ' ');
    $ret    = substr($limit, 0, $pos);


    return $ret;

 }


 function get_ext($name_file){

      $pos    = strrpos($name_file, '.');
      $exe    = substr($name_file, $pos, 5);

return $exe;
}


function sgc_upload_files($file,$files_accept,$type_file,$mode_name,$mod_id = 0){
  $pasta    = "../uploads/"; //nome da pasta que ira salvar os arquivos
  if(!file_exists($pasta)){mkdir($pasta, 0755);}//se a pasta não existiir cria a pasta



  if($file['tmp_name']){//só aceita arquivo de imagem

    $extencao   = get_ext($file['name']);//pega a extenção do arquivo
    $filename   = md5(time()).$extencao;
    


    if(in_array($extencao, $files_accept)){
      $pasta  = $pasta.$type_file.'/';
      
      if(!file_exists($pasta)){mkdir($pasta, 0755);}

      if(move_uploaded_file($file['tmp_name'], $pasta.$filename)){
        
        $resposta = array();
        $resposta['code']   = 1;
        $resposta['title']  = "Sucesso!";
        $resposta['text']   = $type_file." enviada com sucesso";
        $resposta['type']   = "success";
        echo json_encode($resposta);
              

        //salvando na tabela midias
        $data = array();
        $data['name']             = $filename;
        $data['user_id']          = $_SESSION['id'];
        $data['created_date']     = date('Y-m-d H:i:s');
        $data['type']             = $type_file;
        $data['mod_name']         = $mode_name;
        $data['object_id']        = $mod_id;
        sgc_save_db("cap_images_objects", $data, 0);


      }else{
        
        $resposta = array();
        $resposta['code']   = 1;
        $resposta['title']  = "Erro!";
        $resposta['text']   = "Erro ao enviar ".$type_file;
        $resposta['type']   = "error";
        echo json_encode($resposta);
      }//fim da area que move o arquivo


    }else{
      

        $resposta = array();
        $resposta['code']   = 1;
        $resposta['title']  = "Ops!";
        $resposta['text']   = "O arquivo selecionado não é aceito";
        $resposta['type']   = "info";
        echo json_encode($resposta);
    }


  }else{

        $resposta = array();
        $resposta['code']   = 1;
        $resposta['title']  = "Ops!";
        $resposta['text']   = "Selecione um arquivo";
        $resposta['type']   = "info";
        echo json_encode($resposta);
    
  }
}//fim da função de upload de arquivos


function remove_all_midias($mode_name,$type){

$pasta = "../uploads/".$type."/";
$query = "SELECT name FROM cap_images_objects WHERE user_id = :id AND mod_name = '".$mode_name."'";
$search = conecta()->prepare($query);
$search->bindValue(':id', $_SESSION['id']);
$search->execute();
$rows_name_file = $search->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows_name_file as $imgs) {
  unlink ($pasta.$imgs['name']);
}

$query = "DELETE FROM cap_images_objects WHERE user_id = :id AND mod_name = '".$mode_name."'";
$del_img_profile = conecta()->prepare($query);
$del_img_profile->bindValue(':id', $_SESSION['id']);
$retorno = $del_img_profile->execute();


    $ret = array();
    $ret['error_number'] = $retorno[1];
    $ret['error_info'] = $retorno[2];    
return $ret;


}






function sgc_remove_medias($mod_name,$ids){
$ret = array();
$pasta = "../uploads/imagem/";
$query = "SELECT name FROM cap_images_objects WHERE id IN(".$ids.") AND mod_name = ?";
$search = conecta()->prepare($query);
$search->execute(array($mod_name));
$rows_name_file = $search->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows_name_file as $imgs) {
  unlink ($pasta.$imgs['name']);
}

$query = "DELETE FROM cap_images_objects WHERE id IN(".$ids.") AND mod_name = ?";
$del_img_profile = conecta()->prepare($query);
$retorno = $del_img_profile->execute(array($mod_name));


    
    $ret['error_number'] = $retorno[1];
    $ret['error_info'] = $retorno[2];    
return $ret;


}







function sgc_currency($valor){

  
$valor = str_replace('.','',$valor);
$valor = str_replace(',','.',$valor);
return $valor;
}


}
?>

