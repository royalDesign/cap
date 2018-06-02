<?php
if(!empty($_POST['exec'])){

switch ($_POST['exec']) {

case 'delete_itens_selected':
{

$ids = strip_tags(trim($_POST['ids_delete']));
$tabela = "cap_users";
$ret = sgc_delete_db($tabela, $ids);
if(!$ret[2]){

	echo "<script>new PNotify({title: 'Sucesso!',text: 'Itens excluidos com sucesso.',type: 'success'});</script>";
}else{
	echo "<script>new PNotify({title: 'Error!',text: 'Não foi possível excluir este item.',type: 'error'});</script>";
}

}break;

}
}

$query = "SELECT * FROM cap_users";
$search = conecta()->prepare($query);
$search->execute();
$rows = $search->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="content-header">
      <h1>Categorias dos objetos</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void();" onclick="open_target('target=home');"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categorias dos objetos</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
          <div class="box box-primary">
            <div class="box-header">


            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<table id="users" class="table table-bordered table-hover">

                <thead>
                <tr>
                  <th style="width: 30px;" id="check_all_r"><input type="checkbox" onclick="select_all_item_list();" class="check_all"></th>
                  <th>Nome</th>
                  <th>Usuário</th>
                  <th>Função</th>
                  <th>Perfil</th>   
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>

<?php foreach($rows as $row):
$access_type = ($row['access_type'] == 'admin')?'<span class="label label-success">Administrador</span>':'<span class="label label-info">Padrão</span>';
$status = ($row['status'] == 1)?'<i class="fa fa-check text-success" title="Ativo"></i>':'<i title="Bloqueado" class="fa fa-times text-danger"></i>';
?>
    <tr>
      <td><input type="checkbox" class="check_item" value="<?php echo $row['id']?>"></td>
      <td onclick="open_target('target=user&id=<?php echo $row['id'];?>');" style="cursor: pointer;"><?php echo $row['name']?></td>
      <td><?php echo $row['username']?></td>
      <td><?php echo $row['office']?></td>
      <td><?php echo $access_type;?></td>
      <td><?php echo $status;?></td>
    </tr>
    <?php endforeach; ?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th style="width: 30px;" id="id"><input type="checkbox" class="check_all" value="<?php echo $row['id']?>"></th>
                  <th>Nome</th>
                  <th>Usuário</th>
                  <th>Função</th>
                  <th>Perfil</th>
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
    var params = 'target=users&exec=delete_itens_selected&ids_delete='+items_checked;
	open_target(params,btn);
}else{
new PNotify({title: 'Nenhum item selecionado!',text: 'Selecione o item da lista que deseja excluir.',type: 'error'});	
}

}//End delete_confirmed_itens_list



</script>





<script>
  $(function () {
    $('#users').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

   $('#users_filter').append('<div class="btn-group"><button type="button" class="btn btn-primary" id="new_register"><i class="fa fa-plus"></i> Novo</button><button type="button" class="btn btn-primary" onclick="delete_itens_list();"><i class="fa fa-trash"></i> Excluir</button></div><p style="display:none" id="confirm_delete"><strong><a class="text-danger" href="javascript:void()" onclick="delete_confirmed_itens_list($(this));">Confirmar exclusão dos itens selecionados!</a></strong></p>');


    $('input[type="search"]').removeClass('input-sm');
    $('select[name="users_length"]').removeClass('input-sm');
    

    $('#users_filter').on('click', '#new_register', function() {
    	open_target('target=user&id=0');
    	/* Act on the event */
    });

 })
</script>