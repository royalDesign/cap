<?php
$data = array();
$data['last_access'] = date('Y-m-d H:i:s');
$ret = sgc_save_db('users', $data, $user['id']);

if($ret){
session_destroy();
echo"<script language='javascript'> window.location='../';</script>'";	
}

?>