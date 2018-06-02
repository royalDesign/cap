<?php 
require_once "class/sgc_functions.php";
if(empty($user)){
echo"<script language='javascript'> window.location='../';</script>'";

}

$query = "SELECT u.*,m.name AS name_img_profile,m.type FROM cap_users AS u LEFT JOIN cap_images_objects AS m ON m.user_id = u.id AND m.mod_name = 'img_profile_user' WHERE u.id = :id ORDER BY m.id DESC";
$search = conecta()->prepare($query);
$search->bindValue(':id', $user['id']);
$search->execute();
$row = $search->fetch(PDO::FETCH_ASSOC);
if($row['name_img_profile']){
  $img_profile_src =  "uploads/".$row['type']."/".$row['name_img_profile'];
}else{
  $img_profile_src = 'img/user.png';
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Controle de achados e perdidos | Unime</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables_net_bs/css/dataTables.bootstrap.min.css">


  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
 <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="bower_components/bootstrap_daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!--Pnotfy-->
  <link rel="stylesheet" href="css/pnotify.custom.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="bower_components/select2/dist/css/select2.css">
<style>
    .content_img_list{
    width: 110px;
    height: 110px;
    padding: 5px;
    overflow: hidden;
    align-content: center;
    border: solid 2px #ccc;
    }
    
    .content_img_list img{
        width: 110px;
    }
    .imgs_products{
    width: 150px;
    height: 150px;
    background-position: center;
    background-size: 150px;
    background-repeat: no-repeat;
    display:  inline-block;
    border-radius: 50% !important;
  margin-left: 15px;
    margin-bottom: 5px;
    }
    
</style>
<link rel="stylesheet" href="css/shadowbox.css" />
</head>

<body class="hold-transition skin-blue  sidebar-mini">
    
    
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="javascript:void()" onclick="open_target('target=home');" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img title="Sistema para controle de achados e perdidos" src="../img/logo2mini.png" width="50px"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img title="Sistema para controle de achados e perdidos" src="../img/logo2.png" width="200px"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo $img_profile_src;?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">
              
            <?php echo $user['name'];?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo $img_profile_src;?>" class="img-circle" alt="User Image">

                <p>
<?php echo $user['name'];?> <small>Último Acesso: <?php echo sgc_date_format($user['last_access'],'d/m/Y H:i');?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                
                
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="javascript:void()" onclick="open_target('target=profile');" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="javascript:void()" onclick="open_target('target=logout');" class="btn btn-default btn-flat"><i class="fa  fa-sign-out"></i> Sair</a>
                </div>
              </li>
            </ul>
          </li>
         
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

         
      <!-- CONTEUDO DO MENU AQUI -->
      
    <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="javascript:void()" onclick="open_target('target=home');"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-book" aria-hidden="true"></i><span>Gestão de achados</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
<li><a href="javascript:void(0)" onclick="open_target('target=products');"><i class="fa fa-circle-o text-aqua"></i>achados e perdidos</a></li>
<li><a href="javascript:void(0)" onclick="open_target('target=products_categories');"><i class="fa fa-circle-o text-aqua"></i>Categoria dos objetos</a></li>
            
          </ul>
        </li>
        <?php if($user['access_type'] == 'admin'):?>
        <li><a href="javascript:void()" onclick="open_target('target=users');"><i class="fa fa-user"></i> <span>Usuários</span></a></li>
        <?php endif; ?>
        
      </ul>
      <!-- /.sidebar-menu -->
      
      <!--FIM DO CONTEUDO DO MENU AQUI -->
      
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

<div id="conteudoGeral">
    <!-- CONTEUDO DO SITE AQUI -->
 


 <!-- FIM CONTEUDO -->


</div>


  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y')?> <a href="#">R Agência Web</a>.</strong> Todos os direitos reservados.
  </footer>

    
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="js/jquery.form.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap_daterangepicker/daterangepicker.js"></script>

<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.br.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!--
<script src="dist/js/demo.js"></script>
-->
<script src="bower_components/jquery-knob/js/jquery.knob.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="bower_components/chart_js/Chart.js"></script>

<!-- DataTables -->
<script src="bower_components/datatables_net/js/jquery.dataTables.js"></script>
<script src="bower_components/datatables_net_bs/js/dataTables.bootstrap.js"></script>



<script type="text/javascript" src="js/pnotify.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.min.js"></script>
<script type="text/javascript" src="js/sgc_functions.js"></script>
<script type="text/javascript" src="js/shadowbox.js"></script>

<script type="text/javascript">open_target('target=home'); </script>


</body>
</html>
