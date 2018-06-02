<?php
session_start();
if(!empty($_SESSION)){
$user = array();
   foreach ($_SESSION as $key => $value) {
      $user[$key] = $value;
   }
   
}

function conecta(){ 
   //CONEXAO OFLLINE

   $host = "localhost";
   $usuario = "root";
   $senha = "";
   $bandoDados = "lost_and_found_db";

 

   try{
   $pdo = new PDO("mysql:host=$host;dbname=$bandoDados","$usuario","$senha");  
   
   }catch (PDOException $erro){
       echo"Erro ao conectar com o banco de dados".$erro->getMessage();
   }
   return $pdo;
}//end Conecta



function redirect(){
        
   echo"<script language='javascript'> window.location='sistema/'; </script>";        
    
}



?>