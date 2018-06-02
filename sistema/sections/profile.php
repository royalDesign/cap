<?php

if(!empty($_POST['exec'])){

switch ($_POST['exec']) {

case 'save_profile':
{
$id = $user['id'];
$data = array();

if($_POST['password2'] != '' && $_POST['password'] != ''){  
$data['password_show']  = $_POST['password2'];
$data['password']       = trim(md5($_POST['password']));
}
$data['name'] = trim(strip_tags($_POST['name']));
$data['genre'] = trim(strip_tags($_POST['genre']));
$data['username'] = trim(strip_tags($_POST['username']));


$ret = sgc_save_db('cap_users', $data, $id);

if(!$ret['error_number']){
  
  echo "<script>new PNotify({title: 'Sucesso!',text: 'Perfil salvo com sucesso.',type: 'success'});</script>";

}else{
  print_r($ret);
  echo "<script>new PNotify({title: 'Error!',text: 'Não foi possível realizar esta operação.',type: 'error'});</script>";
}

}break;//END save profile


case 'remove_img_profile':  
  {

        $type           = "imagem";
        $mode_name      = "img_profile_user";
        $ret = remove_all_midias($mode_name,$type);

if(!$ret['error_number']){
  
    echo "<script>new PNotify({title: 'Sucesso!',text: 'Imagem removida com sucesso.',type: 'success'});</script>";

        }else{
    print_r($ret);
    echo "<script>new PNotify({title: 'Error!',text: 'Não foi possível realizar esta operação INTERNO.',type: 'error'});</script>";
    }      

        


  }break;


}//END SWITCH
}//END IF
















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

<section class="content-header">
      <h1>Perfil do usuário</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void();" onclick="open_target('target=home');"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Perfil do usuário</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
<div class="profile-user-img img-responsive img-circle" style="background-image: url(<?php echo $img_profile_src;?>);width: 150px;
    height: 150px; background-position: center;
    background-size: 150px; background-repeat: no-repeat; border-radius: 50% !important;">

</div>

              <h3 class="profile-username text-center"><?php echo $row['name'];?></h3>

              <p class="text-muted text-center"><?php echo $row['office'];?></p>

              <div class="row">
                <div class="col-sm-12">
        <form name="img_profile">
                <div class="input-group input-group-sm">
                <input type="file" name="arquivo" id="arquivo" class="form-control">
                
                <input type="hidden" name="mod_id" id="mod_id" value="<?php echo $row['id']; ?>" />
                
                <?php if($row['name_img_profile']){ ?>
                    <span class="input-group-btn">
                <button type="button" id="send_img" title="Remover imagem de perfil" onclick ="trash_img_profile();" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                    </span>
                    <?php } ?>
              </div>       
 
</form>
              </div>
            </div><!--END ROW-->


        <div class="row" style="margin-top: 10px;">
          <div class="col-sm-12">
            <div class="progress mb-2" id="profile_b" style="display: none;">
  <div class="progress-bar progress-bar-striped progress-bar-animated" id="profile_p" role="progressbar" style="width: 0%; height: 20px;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div>
          </div>
        </div>            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">              
              <li class="active"><a href="#cadastro" data-toggle="tab">Cadastro</a></li>
              <!--li><a href="#timeline" data-toggle="tab">Timeline</a></li -->              
            </ul>
            <div class="tab-content">




<div class="tab-pane active" id="cadastro">
                <form role="form" action="" method="POST" name="profile_user" enctype="multipart/form-data">
    <div class="box-body">
        <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text"  name="name" autocomplete="off"  class="form-control" id="name" placeholder="Nome completo" value="<?php echo $row['name']?>">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="genre">Gênero</label>
                <select name="genre" id="genre" class="form-control">
                     <option value="">--Selecione--</option>
                    <option <?php echo ($row['genre'] == 'M')?'selected':''; ?> value="M">M</option>
                    <option <?php echo ($row['genre'] == 'F')?'selected':''; ?> value="F">F</option>
                </select>
            </div>
        </div>
        </div><!--END ROW-->
        
      <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="username">E-mail</label>
                <input type="email"  name="username" autocomplete="off"  class="form-control" id="username" value="<?php echo $row['username']?>">
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label for="password">Nova senha</label>
                <input type="password"  name="password" value="" autocomplete="off"  class="form-control" id="password">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="password2">Confirmar senha</label>
                <input type="password"  name="password2" value="" autocomplete="off"  class="form-control" id="password2">
            </div>
        </div>
      </div><!--END ROW-->
      
 <div class="row">
  <div class="col-sm-6">
                  <button type="button" name="sgc_save" id="sgc_save" onclick="sgc_save_main();" class="btn btn-primary"><i class="fa fa-check"></i> Salvar</button>
                  </div>
              </div>
                  
</div><!--END box body-->
              
             
            </form>
</div><!--END PANE CADASTRO -->


            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
<script>

function sgc_save_main(){
var form    = $('form[name="profile_user"]');
var btn     = $('#sgc_save');
var name    = $('#name');
var username    = $('#username');
var genre   = $('#genre');
var password = $('#password');

var params      = 'target=profile&exec=save_profile&'+form.serialize();
if(valid_fild('required',name) && valid_fild('email',username) && valid_fild('select',genre) && valid_fild('password',password) ){
open_target(params,btn);


}

}


function trash_img_profile(){
             
  var params    = 'target=profile&exec=remove_img_profile';
  var btn       = $('#send_img');
  //var target    = 'profile';
  //sgc_admin(params,target);
  open_target(params,btn);

            
}


$('input[type=file]').on("change", function(){  
$(this).each(function(index){
        if ($('input[type=file]').eq(index).val() != ""){

            var sender    = $('form[name="img_profile"]'); 
            var rotina    = 'save_img_profile';
            send_form_file(sender,'profile',rotina);
            
            
            
        }
    });

});


$('#birth_date').datepicker({
autoclose: true,
language: 'br'
});
</script>

