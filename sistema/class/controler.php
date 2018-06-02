<?php 
require_once "sgc_functions.php";

if(!empty($_POST['exec'])){

switch ($_POST['exec']) {

case 'logar':
{
$data = array();
$data[] = strip_tags(trim($_POST['email']));
$data[] = md5(strip_tags(trim($_POST['senha'])));

$query = "SELECT * FROM cap_users WHERE email = ? AND password = ?";
$valid_log = conecta()->prepare($query);
$valid_log->execute($data) or die(print_r($erro = $valid_log->errorInfo()));
$row = $valid_log->fetch();
$result = $valid_log->rowCount();

if($result > 0){
	foreach ($row as $key => $value){
		if(!is_numeric($key) && $key != 'password_show')
			$_SESSION[$key] = $value;
	}
redirect($user['customer_code']);


}else{
	echo '-1';
}

}break;




case 'save_img_profile':	
	{

        $arquivo		  = $_FILES['arquivo'];
        $files_accept             = array('.jpg','.jpeg','.png', '.gif');
        $type			  = "imagem";
        $mode_name		  = "img_profile_user";
        $mod_id                  = $_POST['mod_id'];

        remove_all_midias($mode_name,$type);
        sgc_upload_files($arquivo,$files_accept,$type,$mode_name,$mod_id);	

	}break;

            
case 'save_img_product':	
{

$arquivo		  = $_FILES['arquivo'];
$files_accept             = array('.jpg','.jpeg','.png', '.gif');
$type			  = "imagem";
$mod_name		  = "img_objects";
$mod_id                   = $_POST['mod_id'];

//remove_all_midias($mode_name,$type);
sgc_upload_files($arquivo,$files_accept,$type,$mod_name,$mod_id);	

}break;


default:
    //echo "Rotina não configurada";
    break;


}/*END ROTINAS EXEC*/
}/*END IF ROTINAS EXEC*/


if(!empty($_POST['target'])){	

	$file_target = "../sections/".$_POST['target'].".php";

	if (file_exists($file_target)) {
		require_once $file_target;
	}else{
		require_once "../sections/404.php";
	}

		
}/*END IF ROTINAS menu*/

?>