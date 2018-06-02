<?php 
if(!empty($_POST['exec'])){

switch ($_POST['exec']) {
	
case 'save_products_category':	
{
$id = $_POST['id'];

$data = array();
$data['name'] = trim(strip_tags($_POST['name']));
$data['description'] = trim(strip_tags($_POST['description']));
$data['status'] = trim(strip_tags($_POST['status']));
if(!$id){
$data['created_date'] = date('Y-m-d H:i:s');
$data['created_user'] = $user['id'];
}
$ret = sgc_save_db('cap_objects_categories', $data, $id);

if(!$ret['error_number']){
	if($ret['new_id']){
		$_POST['id'] = $ret['new_id'];
	}
	echo "<script>new PNotify({title: 'Sucesso!',text: 'Dados salvos com sucesso.',type: 'success'});</script>";	
}else{
  print_r($ret);
	echo "<script>new PNotify({title: 'Error!',text: 'Não foi possível realizar esta operação.',type: 'error'});</script>";
}

    
}break;
	
	
}
}


$query = "SELECT a.*,u.name AS name_created FROM cap_objects_categories AS a LEFT JOIN cap_users AS u ON u.id = a.created_user WHERE a.id = :id";
$search = conecta()->prepare($query);
$search->bindValue(':id', $_POST['id']);
$search->execute();
$row = $search->fetch(PDO::FETCH_ASSOC);

?>
<section class="content-header">
      <h1>Categoria de produto</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void();" onclick="open_target('target=home');"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void();" onclick="open_target('target=products_categories');">Categorias dos produtos</a></li>
        <li class="active">Categoria</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
<div class="row">


        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">              
              <li class="active"><a href="#cadastro" data-toggle="tab">Cadastro</a></li>
                          
            </ul>
            <div class="tab-content">




<div class="tab-pane active" id="cadastro">
                <form role="form" action="" method="POST" name="form_main" enctype="multipart/form-data">
    <div class="box-body">
        <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text"  name="name" autocomplete="off"  class="form-control" id="name" placeholder="Nome completo" value="<?php echo $row['name']?>">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                     <option value="">--Selecione--</option>
                    <option <?php echo ($row['status'] == '1')?'selected':''; ?> value="1">Ativo</option>
                    <option <?php echo ($row['status'] == '0')?'selected':''; ?> value="0">Inativo</option>
                </select>
            </div>
        </div>
        </div><!--END ROW-->

        <div class="row">


        <div class="col-sm-12">
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"><?php echo $row['description']; ?></textarea>

                <input type="hidden" name="id" id="id" value="<?php echo $_POST['id'];?>">
            </div>
        </div>
        
        </div><!--END ROW-->

     <div class="row">
                <div class="col-sm-6">
                  <button type="button" name="sgc_save" id="sgc_save" onclick="sgc_save_main($(this));" class="btn btn-primary btn_action"><i class="fa fa-check"></i> Salvar</button>
                </div>
                <div class="col-sm-6">
              <button type="button" onclick="open_target('target=products_categories', $(this));" class="btn btn-default pull-right rr"> Voltar</button>
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

<?php if ($row['id']): ?>
        <div class="col-md-4">
  	<div class="box box-primary">
    	<div class="box-body box-profile">
    		<div class="box-header with-border">
             <h3 class="box-title">Resumo</h3>
            </div>


            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  Criado por <br><a><?php echo $row['name_created']; ?></a> em <a><?php echo sgc_date_format($row['created_date'],'d/m/Y H:i'); ?></a>
                </li>
		          
              </ul>


							
          
			
    	</div>            
  	</div>
</div>
<?php endif; ?>

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <script>
  	
function sgc_save_main(btn){

var form    		= $('form[name="form_main"]');
var name    		= $('#name');
var status   	  	= $('#status');
var description   	= $('#description');
var params 			= 'target=products_category&exec=save_products_category&'+form.serialize();

if(valid_fild('required',name) && valid_fild('select',status)){
open_target(params,btn);
}
}

  </script>