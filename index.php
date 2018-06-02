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
        <div class="col-xs-5 pull-right"> 
            <button name="Entrar" id="j_send" onclick="logar();" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
   

    
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


</body>
</html>
