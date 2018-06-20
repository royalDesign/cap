<?php


if(!empty($_POST['exec'])){

switch ($_POST['exec']) {

case 'delete_itens_selected':
{

$ids = strip_tags(trim($_POST['ids_delete']));



$query = "SELECT name FROM cap_images_objects WHERE object_id IN(".$ids.") AND mod_name = 'img_objects'";
$search = conecta()->prepare($query);
$search->execute();
$rows_name_file = $search->fetchAll(PDO::FETCH_ASSOC);
$pasta = "../uploads/imagem/";
foreach ($rows_name_file as $imgs) {
  unlink ($pasta.$imgs['name']);
}

$query = "DELETE FROM cap_images_objects WHERE object_id IN(".$ids.") AND mod_name = 'img_objects'";
$del_img_profile = conecta()->prepare($query);
$retorno = $del_img_profile->execute();



$tabela = "cap_objects";
$ret = sgc_delete_db($tabela, $ids);


if(!$ret[2]){

	echo "<script>new PNotify({title: 'Sucesso!',text: 'Itens excluidos com sucesso.',type: 'success'});</script>";
}else{
	echo "<script>new PNotify({title: 'Error!',text: 'Não foi possível excluir este item.',type: 'error'});</script>";
}

}break;

}
}

$query = "SELECT p.*,pc.name AS name_category FROM cap_objects AS p LEFT JOIN cap_objects_categories AS pc ON pc.id = p.category_id";
$search = conecta()->prepare($query);
$search->execute();
$rows = $search->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="content-header">
      <h1>Gestão de achados e perdidos</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void();" onclick="open_target('target=home');"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gestão de achados e perdidos</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
          <div class="box box-primary">
            <div class="box-header">


            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<table id="products" class="table table-bordered table-hover">

                <thead>
                <tr>
                  <?php if($user['access_type'] == 'admin'):?>
                    <th style="width: 10px;" id="check_all_r"><input type="checkbox" onclick="select_all_item_list();" class="check_all"></th>
                  <?php endif;?>
                    
                  <th style="width: 100px;">Imagem</th>
                  <th style="width: 50px;" >Código</th>                  
                  <th>Local</th>
                  <th>Descrição</th>
                  <th>Data</th>
                  <th>Categoria</th>                  
                  <th style="width: 50px;">Status</th>                  
                </tr>
                </thead>
                <tbody>

<?php foreach($rows as $row):
    if($row['status'] == 1){
         $status = '<span class="label label-success" title="Objeto disponível para devolução ao dono">Em posse</span>';
    }else if($row['status'] == 2){
          $status = '<span class="label label-info" title="Objeto entregue ao dono">Entregue</span>';
    }else if($row['status'] == 3){
          $status = '<span class="label label-primary" title="Objeto doado">Doado</span>';
    }else{
          $status = '<span class="label label-danger" title="Objeto com mais de '.$_SESSION['days_donate'].' dias em posse">Disp. p/ doação</span>';
    }

$query = "SELECT id,name FROM cap_images_objects WHERE mod_name = 'img_objects' AND object_id = ? AND type = 'imagem' ORDER BY id LIMIT 1";
$row_image_object = conecta()->prepare($query);
$row_image_object->execute(array($row['id']));
$row_image_object = $row_image_object->fetch(PDO::FETCH_ASSOC);
?>
    <tr>
        <?php if($user['access_type'] == 'admin'):?>
      <td><input type="checkbox" class="check_item" value="<?php echo $row['id']?>"></td>   
      <?php endif;?>
      
      <td style="cursor: pointer;">           
          <?php if($row_image_object['name']):?>
          <a href="uploads/imagem/<?php echo $row_image_object['name'];?>" rel="shadowbox">
          <div class="profile-user-img img-responsive img-circle imgs_products" style="background-image: url(uploads/imagem/<?php echo $row_image_object['name'];?>);"></div>
          </a>
          
              <?php else:?>
          <a href="uploads/imagem/default.png" rel="shadowbox">
          <div class="profile-user-img img-responsive img-circle imgs_products" style="background-image: url(uploads/imagem/default.png);"></div>
          </a>
              <?php endif;?>
      </td>
      <td><?php echo "OBJ-".$row['id']?></td>
      <td onclick="open_target('target=product&id=<?php echo $row['id'];?>');" style="cursor: pointer;"><?php echo $row['found_location']?></td>
      <td onclick="open_target('target=product&id=<?php echo $row['id'];?>');" style="cursor: pointer;"><?php echo $row['description']?></td>      
      <td onclick="open_target('target=product&id=<?php echo $row['id'];?>');" style="cursor: pointer;"><?php echo sgc_date_format($row['entry_date'],'d/m/Y')?></td>
      <td onclick="open_target('target=product&id=<?php echo $row['id'];?>');" style="cursor: pointer;"><?php echo $row['name_category']?></td>
      <td onclick="open_target('target=product&id=<?php echo $row['id'];?>');" style="cursor: pointer;"><?php echo $status;?></td>
      
    </tr>
    <?php endforeach; ?>
                
                </tbody>
                <tfoot>
                <tr>
                    <?php if($user['access_type'] == 'admin'):?>
                  <th id="id"><input type="checkbox" class="check_all" value="<?php echo $row['id']?>"></th>                  
                  <?php endif;?>
                  <th>Imagem</th>
                  <th>Código</th>
                  <th>Local</th>
                  <th>Descrição</th>
                  <th>Data</th>
                  <th>Categoria</th>                  
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
</section>
<script>
	
function delete_itens_list(){

	var check_item = $('.check_item');

if(!check_item.is(':checked')){
new PNotify({title: 'Nenhum item selecionado!',text: 'Selecione o item da lista que deseja excluir.',type: 'error'});
}else{ $('#confirm_delete').toggle('slow'); }
}//end delete_itens_list


function delete_confirmed_itens_list(btn){

var check_item = $('.check_item');
if(check_item.is(':checked')){
items_checked = new Array();
$("input[type=checkbox][class='check_item']:checked").each(function(){
    items_checked.push($(this).val());
});
    var params = 'target=products&exec=delete_itens_selected&ids_delete='+items_checked;
	open_target(params,btn);
}else{
new PNotify({title: 'Nenhum item selecionado!',text: 'Selecione o item da lista que deseja excluir.',type: 'error'});	
}

}//End delete_confirmed_itens_list



</script>





<script>
  $(function () {
    $('#products').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

   $('#products_filter').append('<div class="btn-group"><button type="button" class="btn btn-primary" id="new_register"><i class="fa fa-plus"></i> Novo</button><button id="excluir" type="button" class="btn btn-primary" onclick="delete_itens_list();"><i class="fa fa-trash"></i> Excluir</button></div><p style="display:none" id="confirm_delete"><strong><a class="text-danger" href="javascript:void()" onclick="delete_confirmed_itens_list($(this));">Confirmar exclusão dos itens selecionados!</a></strong></p>');
<?php if($user['access_type'] == 'user'):?>
$('#excluir').remove();
<?php endif;?>

    $('input[type="search"]').removeClass('input-sm');
    $('select[name="products_length"]').removeClass('input-sm');
    

    $('#products_filter').on('click', '#new_register', function() {
    	open_target('target=product&id=0');
    	/* Act on the event */
    });

 })
</script>