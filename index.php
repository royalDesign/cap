<?php
@session_start();
if(isset($_SESSION['id'])){echo"<script language='javascript'> window.location='sistema/';</script>'";}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Entrar | Controle de achados e perdidos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <script src="https://use.fontawesome.com/e31dd27cd9.js"></script>
  
  
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.css">
  <link rel="stylesheet" type="text/css" href="css/r_style.css">
    
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!--Pnotfy-->
  <link rel="stylesheet" href="css/pnotify.custom.min.css">
  <link rel="stylesheet" href="css/animate.css">
  
</head>

<body class="hold-transition login-page fundo">
  
<div class="login-box">
  
  <div class="login-box-body">

<div class="logo"><img src="img/logo.png"></div>
    <hr>
    <div class="debug" style="display: none;"></div>
    <form action="" class="login-form" enctype="multipart/form-data"  method="post" name="login" id="login">
      <div class="form-group has-feedback">
          <label for="email">E-mail </label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Digite seu email">
          
        <span class="form-control-feedback"><i class="fa fa-envelope"></i></span>
      </div>
      <div class="form-group has-feedback">
          <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe a sua senha">          
            <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
      </div>
      <div class="row">              
          
          <div class="col-xs-7 pull-left"> 
              <div class="form-group">
              <button type="button" name="recover_password" id="recover_password" onclick="sgc_recover_password();" class="btn btn-primary btn-block btn-flat"><i class="fa fa-unlock-alt"></i> Recuperar senha</button>
              </div></div>
          
        <div class="col-xs-5 pull-right"> 
            <div class="form-group">
            <button name="Entrar" id="j_send" onclick="logar();" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Entrar</button>
        </div>
            </div>
        <!-- /.col -->
      </div>  
        
    </form>
    
    <div class="content-recover" style="display: none;">
 <div class="row">
     <form name="recovery_password_mail">
    <div class="col-sm-12">
        <label for="email_recovery">E-mail </label>
<div class="input-group input-group-md form-group">  
   
    <input type="email" name="email_recovery" id="email_recovery" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat j_send_recover" onclick="send_mail_recovery()">Enviar</button>
                    </span>
   
              </div>
    </div>
           </form>
</div> 
        
        
        <div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <button class="btn btn-sm btn-info form-control" onclick="prev_form_login();">Voltar ao formulário de login</button>
            </div>
        </div>
    </div>
        
</div>

    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/pnotify.custom.min.js"></script>
<script type="text/javascript" src="js/sgc_functions.js"></script>

<script>

function sgc_recover_password(){
    $('.login-form').slideUp('slow', function (){
        $('.content-recover').slideDown('slow');
    });
    
}

function prev_form_login(){
     $('.content-recover').slideUp('slow', function (){         
        $('.login-form').slideDown('slow');
    });
}
</script>

</body>
</html>
