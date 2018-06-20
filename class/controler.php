<?php 
require_once "sgc_functions.php";

                $query = "SELECT days_donate FROM cap_configurations";
                $days_donate = conecta()->prepare($query);
                $days_donate->execute();
                $days_donate = $days_donate->fetch(PDO::FETCH_ASSOC);
                $_SESSION['days_donate'] = $days_donate['days_donate']; 
                
if(!empty($_POST['exec'])){

switch ($_POST['exec']) {

    case 'recuperar_senha':
    {
            print_r($_POST);
    }break;
    
case 'logar':
{
$data = array();
$data[] = strip_tags(trim($_POST['email']));
$data[] = trim(md5($_POST['senha']));

$query = "SELECT u.* FROM cap_users AS u WHERE u.username = ? AND u.password = ?";
$valid_log = conecta()->prepare($query);
$erro = $valid_log->errorInfo();
$valid_log->execute($data);
$row = $valid_log->fetch();
$result = $valid_log->rowCount();

if($result > 0){
    
    
if($row['status'] != 1){
    echo '-2';
}else{
    

	foreach ($row as $key => $value){
		if(!is_numeric($key) && $key != 'password_show' && $key != 'password')
			$_SESSION[$key] = $value;                
	}
        
        $query = "SELECT id FROM cap_objects WHERE DATEDIFF(DATE(CURDATE()),entry_date) > ? AND status = 1";
        $rows_donate = conecta()->prepare($query);
        $rows_donate->execute(array($_SESSION['days_donate']));
        $rows_donate = $rows_donate->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($rows_donate AS $row){
                $query = "UPDATE cap_objects SET status = 4 WHERE id = ?";
                $rows_donate_up = conecta()->prepare($query);
                $rows_donate_up->execute(array($row['id']));

                $data_timeline = array();
                $data_timeline['created_user'] = 0;
                $data_timeline['created_date'] = date('Y-m-d H:i:s');
                $data_timeline['item_id'] = $row['id'];
                $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                $data_timeline['title'] = 'Sistema atualizou este objeto';
                $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Status</strong></p> <strong>De</strong> Em posse <br><strong>para</strong> Disponível para doação';
                                
                $query_insert = "INSERT INTO cap_objects_updates (created_user,created_date,item_id,icon,title,content) VALUES (?,?,?,?,?,?)";
                $insert = conecta()->prepare($query_insert);
                $insert->execute($data_timeline['created_user'],$data_timeline['created_date'],$data_timeline['item_id'],$data_timeline['icon'],$data_timeline['title'],$data_timeline['content']);
        
                
              }             
        
               
                
echo 'Efetuando o login';
}

}else{
	echo '-1';
}


}break;

 case 'recovery_send_email':
 {
 $return = array();
 $return['error_number'] = 0;
 $return['message'] = '';
 
$data = array();
$data[] = strip_tags(trim($_POST['email']));
$query = "SELECT u.* FROM cap_users AS u WHERE u.username = ?";
$valid_log = conecta()->prepare($query);
$erro = $valid_log->errorInfo();
$valid_log->execute($data);
$row = $valid_log->fetch();
$result = $valid_log->rowCount();

if($result > 0){
    
$arquivo='
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dados de acesso | Controle para achados e perdidos UNIME</title>
    <style>
        body{
  background-color: #ecf0f5;
  margin:0px;
  font-family:Verdane;
  font-size:12px;
  color: #444;
        }
        .box-content{
    width: 500px;
    margin: 10px auto;
    border: solid 1px rgba(0,0,0,.5);
    box-shadow: 1px 1px 5px rgba(0,0,0,.5);
    background-color: #fff;
    padding: 10px;
    border-radius: 3px;
        }
        h4{
    text-align:  left;
    margin:20px 0px 0px 0px;
    font-size: 18px;
        }
    </style>
  </head>
  <body>    
<div class="box-content">
<center>
<img src="http://cap.mypressonline.com/img/logo.png"/>
</center>        
<h4>Recuperação de senha</h4>
<hr>    
<p>Olá <b>'.$row['name'].'</b>, segue abaixo os dados necessários para acesso ao sistema para controle de achados e perdidos unime.</p>
<p><b>E-mail: </b>'.$row['username'].'</p>
<p><b>Senha: </b>'.$row['password_show'].'</p>
<p>Por questões de segurança aconcelhamos que ao logar no sistema acesse o seu perfil de usuário e defina uma nova senha.</p>
<p style="text-align: right;">Esta solicitação foi requerida em <b>'.date('d/m/Y').'</b> as <b>'.date('H:i:s').'</b></p>
</div>    
  </body>
</html>
';

$assunto = "Recuperação de senha - Controle de achados e perdidos Unime"; 
$destino = $row['username'];

$headers  = 'MIME-Version: 1.1' . PHP_EOL;
$headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
$headers .= 'From: Sistema para controle de achados e perdidos | Unime <achadoseperdidos@unime.edu.br>' . PHP_EOL;
$headers .= 'Return-Path: Sistema para controle de achados e perdidos | Unime <achadoseperdidos@unime.edu.br>'; 
    
$enviaremail = mail($destino, $assunto, $arquivo, $headers); 
 
    
  
    
    
    
  $return['error_number'] = 0;
  $return['message'] = 'Em instantes você receberá um e-mail com seus dados de acesso!';
}else{
 $return['error_number'] = 1;
 $return['message'] = 'Não existe nenhum usuário cadastrado com este e-mail';
}
 
 
 
 echo json_encode($return); 
 }break;

	
	default:
		echo "Rotina não configurada";
		break;
}/*END ROTINAS EXEC*/
}/*END IF ROTINAS EXEC*/

?>