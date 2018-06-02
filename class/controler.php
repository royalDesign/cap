<?php 
require_once "sgc_functions.php";

if(!empty($_POST['exec'])){

switch ($_POST['exec']) {

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
        
        $query = "SELECT id FROM cap_objects WHERE DATEDIFF(DATE(CURDATE()),entry_date) > 30 AND status = 1";
        $rows_donate = conecta()->prepare($query);
        $rows_donate->execute();
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
        
redirect();

echo 'Efetuando o login';
}

}else{
	echo '-1';
}


}break;



	
	default:
		echo "Rotina não configurada";
		break;
}/*END ROTINAS EXEC*/
}/*END IF ROTINAS EXEC*/

?>