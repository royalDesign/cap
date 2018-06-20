<?php
if (!empty($_POST['exec'])) {

    switch ($_POST['exec']) {

        case 'save_product': {
                $id = $_POST['id'];

                $query = "SELECT * FROM cap_objects WHERE id = :id";
                $search = conecta()->prepare($query);
                $search->bindValue(':id', $id);
                $search->execute();
                $row_up = $search->fetch(PDO::FETCH_ASSOC);


                $data = array();
                $data['found_location'] = trim(strip_tags($_POST['found_location']));
                $data['description'] = trim(strip_tags($_POST['description']));
                $data['status'] = trim(strip_tags($_POST['status']));
                $data['entry_date'] = sgc_date_format(trim(strip_tags($_POST['entry_date'])), 'Y-m-d');
                $data['category_id'] = trim(strip_tags($_POST['category_id']));
                
                if($data['status'] == 2){
                    $data['owner'] = trim(strip_tags($_POST['owner']));
                    $data['rg_owner'] = trim(strip_tags($_POST['rg_owner']));
                    $data['delivered_date'] = sgc_date_format(trim(strip_tags($_POST['delivered_date'])), 'Y-m-d');
                }else if($data['status'] == 3){
                    $data['owner_donate'] = trim(strip_tags($_POST['owner_donate']));
                    $data['rg_cnpj_donate'] = trim(strip_tags($_POST['rg_cnpj_donate']));
                    $data['donated_date'] = sgc_date_format(trim(strip_tags($_POST['donated_date'])), 'Y-m-d');
                }
                

                if ($id) {
                    $data['modified_date'] = date('Y-m-d H:i:s');
                    $data['modified_user'] = $user['id'];
                } else {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['created_user'] = $user['id'];
                }
                $ret = sgc_save_db('cap_objects', $data, $id);

                if (!$ret['error_number']) {
                    if ($ret['new_id']) {
                        $_POST['id'] = $ret['new_id'];
                    }
                    echo "<script>new PNotify({title: 'Sucesso!',text: 'Dados salvos com sucesso.',type: 'success'});</script>";
                } else {
                    echo "<script>new PNotify({title: 'Error!',text: 'Não foi possível realizar esta operação.',type: 'error'});</script>";
                }

                if ($id) {
//atualização da linha do tempo
                    if ($row_up['found_location'] != $data['found_location']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Local encontrado</strong></p> <strong>De</strong> ' . $row_up['found_location'] . ' <br><strong>para</strong> ' . $data['found_location'];
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }

                    if ($row_up['description'] != $data['description']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Descrição</strong></p> <strong>De</strong> ' . $row_up['description'] . ' <br><strong>para</strong> ' . $data['description'];
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }
                    if($data['status'] == 3){
                    if ($row_up['owner_donate'] != $data['owner_donate']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Instituição/Destinatário</strong></p> <strong>De</strong> ' . $row_up['owner_donate'] . ' <br><strong>para</strong> ' . $data['owner_donate'];
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }
                    
                    if ($row_up['rg_cnpj_donate'] != $data['rg_cnpj_donate']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>RG/CNPJ do beneficiado</strong></p> <strong>De</strong> ' .$row_up['rg_cnpj_donate']. ' <br><strong>para</strong> ' . $data['rg_cnpj_donate'];
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }
                    
                    
                    if ($row_up['donated_date'] != $data['donated_date']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Data da doação</strong></p> <strong>De</strong> '.sgc_date_format($row_up['donated_date'],'d/m/Y'). ' <br><strong>para</strong> ' .sgc_date_format($data['donated_date'],'d/m/Y');
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }
                    }//end if se for doação
                    
                    
                    
                     if($data['status'] == 2){
                    if ($row_up['owner'] != $data['owner']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Proprietário</strong></p> <strong>De</strong> ' . $row_up['owner'] . ' <br><strong>para</strong> ' . $data['owner'];
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }
                    
                    if ($row_up['rg_owner'] != $data['rg_owner']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>RG do propeietário</strong></p> <strong>De</strong> ' .$row_up['rg_owner']. ' <br><strong>para</strong> ' . $data['rg_owner'];
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }
                    
                    
                    if ($row_up['delivered_date'] != $data['delivered_date']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Data da entrega</strong></p> <strong>De</strong> '.sgc_date_format($row_up['delivered_date'],'d/m/Y'). ' <br><strong>para</strong> ' .sgc_date_format($data['delivered_date'],'d/m/Y');
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }
                    }//end if se for entregue
                    
                    

                    if($row_up['status'] != $data['status']) {
                        $all_status = array('','Em posse','Entregue','Doado','Disponível para doação');
                        
                        $up_from = $all_status[$row_up['status']];
                        $up_to = $all_status[$data['status']];
                        
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Status</strong></p> <strong>De</strong> ' . $up_from . ' <br><strong>para</strong> ' . $up_to;
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }

                    if ($row_up['entry_date'] != $data['entry_date']) {
                        $data_timeline = array();
                        $data_timeline['created_user'] = $user['id'];
                        $data_timeline['created_date'] = date('Y-m-d H:i:s');
                        $data_timeline['item_id'] = $id;
                        $data_timeline['icon'] = '<i class="fa fa-book bg-blue"></i>';
                        $data_timeline['title'] = 'Atualizou este objeto';
                        $data_timeline['content'] = '<p style="color: #3c8dbc"><strong>Data</strong></p> <strong>De</strong> ' . $row_up['entry_date'] . ' <br><strong>para</strong> ' . $data['entry_date'];
                        $new_timeline = sgc_save_db('cap_objects_updates', $data_timeline, 0);
                    }
                }//END IF ID
            }break;

        case 'remove_img': {

                $mod_name = "img_objects";
                $ids = $_POST['id_del'];
                $ret = sgc_remove_medias($mod_name, $ids);

                if (!$ret['error_number']) {

                    echo "<script>new PNotify({title: 'Sucesso!',text: 'Imagem removida com sucesso.',type: 'success'});</script>";
//print_r($ret);
                } else {
                    //print_r($ret);
                    echo "<script>new PNotify({title: 'Error!',text: 'Não foi possível realizar esta operação INTERNO.',type: 'error'});</script>";
                }
            }break;




        default:
            //echo "Rotina não configurada";
            break;
    }
}


$query = "SELECT a.*,u.name AS name_created,um.name AS name_modified FROM cap_objects AS a LEFT JOIN cap_users AS u ON u.id = a.created_user LEFT JOIN cap_users AS um ON um.id = a.modified_user WHERE a.id = :id";
$search = conecta()->prepare($query);
$search->bindValue(':id', $_POST['id']);
$search->execute();
$row = $search->fetch(PDO::FETCH_ASSOC);


//timeline
$query = "SELECT a.*,u.name AS name_user FROM cap_objects_updates AS a LEFT JOIN cap_users AS u ON u.id = a.created_user WHERE a.item_id = :id ORDER BY a.id DESC";
$search = conecta()->prepare($query);
$search->bindValue(':id', $_POST['id']);
$search->execute();
$rows_timeline = $search->fetchAll(PDO::FETCH_ASSOC);

//Popula Categorias
$query = "SELECT id,name,description FROM cap_objects_categories WHERE status = 1 ORDER BY name";
$search = conecta()->prepare($query);
$search->execute();
$rows_categories = $search->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="content-header">
    <h1>Objeto</h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void();" onclick="open_target('target=home');"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void();" onclick="open_target('target=products');">Gestão de objetos</a></li>
        <li class="active">Objeto</li>
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
                    <li><a href="#timeline" data-toggle="tab">Atualizações</a></li>              
                </ul>
                <div class="tab-content">




                    <div class="tab-pane active" id="cadastro">

                        <div class="box-body">
                            <form role="form" action="" method="POST" name="form_main" enctype="multipart/form-data">     
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="found_location">Local encontrado</label>
                                            <input type="text"  name="found_location" autocomplete="off"  class="form-control" id="found_location" placeholder="Local onde o objeto foi encontrado" value="<?php echo $row['found_location'] ?>">
                                        </div>
                                    </div>



                                    <div class="col-sm-3">            
                                        <div class="form-group">
                                            <label for="entry_date">Data</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" value="<?php echo sgc_date_format($row['entry_date'], 'd/m/Y'); ?>" OnKeyPress="return sgc_masc_fild(event, this, '##/##/####');"  name="entry_date" id="entry_date" class="form-control pull-right">
                                            </div>
                                        </div>
                                    </div>




                                </div><!--END ROW-->




                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description">Descrição</label>
                                            <input name="description" class="form-control" id="description" value="<?php echo $row['description']; ?>" />

                                            <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>">
                                        </div>
                                    </div>

                                </div><!--END ROW-->

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="category_id">Categoria</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">--Selecione--</option>
<?php foreach ($rows_categories as $row_categories): ?>
                                                    <option title="<?php echo $row_categories['description']; ?>" <?php echo ($row['category_id'] == $row_categories['id']) ? 'selected' : ''; ?> value="<?php echo $row_categories['id']; ?>"><?php echo $row_categories['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select onchange="sgc_show_input_status(this)" name="status" id="status" class="form-control">
                                                <option value="">--Selecione--</option>
                                                <option <?php echo ($row['status'] == '1') ? 'selected' : ''; ?> value="1" title="Objeto disponível para devolução ao dono">Em posse</option>
                                                <option <?php echo ($row['status'] == '2') ? 'selected' : ''; ?> value="2" title="Objeto entregue ao dono">Entregue</option>
                                                <option <?php echo ($row['status'] == '3') ? 'selected' : ''; ?> value="3" title="Objeto doado">Doado</option>
                                                <option <?php echo ($row['status'] == '4') ? 'selected' : ''; ?> value="4" title="Objeto com mais de <?php echo $_SESSION['days_donate'];?> dias em posse">Disp. p/ doação</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status">Código</label>
                                            <input type="text" class="form-control" name="code" value="<?php echo ($row['id'])?"OBJ-".$row['id']:""; ?>" disabled="disabled" />
                                        </div>
                                    </div>
                                    

                                </div><!--END ROW-->
                                
                                
                                
                                <div class="delivered" style="display: <?php echo ($row['status'] ==2)?'block':'none';?>">
                                    <div class="row">
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="owner">Proprietário</label>
                                            <input type="text" id="owner" class="form-control" name="owner" value="<?php echo $row['owner']; ?>" />
                                        </div>
                                    </div>
                                        
                                        
                                     <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="rg_owner">RG</label>
                                            <input type="text" id="rg_owner" class="form-control" name="rg_owner" value="<?php echo $row['rg_owner']; ?>" />
                                        </div>
                                    </div>
                                        
                                        
                                        <div class="col-sm-3">            
                                        <div class="form-group">
                                            <label for="delivered_date">Data</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" value="<?php echo sgc_date_format($row['delivered_date'], 'd/m/Y'); ?>" OnKeyPress="return sgc_masc_fild(event, this, '##/##/####');"  name="delivered_date" id="delivered_date" class="form-control pull-right">
                                            </div>
                                        </div>
                                    </div>                                     
                                        
                                    </div>
                                </div>
                                
                                <div class="donated" style="display: <?php echo ($row['status'] == 3)?'block':'none';?>">
                                      <div class="row">
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="owner_donate">Instituição/Destinatário</label>
                                            <input type="text" id="owner_donate" class="form-control" name="owner_donate" value="<?php echo $row['owner_donate']; ?>" />
                                        </div>
                                    </div>
                                        
                                        
                                     <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="rg_cnpj_donate">RG/CNPJ</label>
                                            <input type="rg_cnpj_donate" id="rg_cnpj_donate" class="form-control" name="rg_cnpj_donate" value="<?php echo $row['rg_cnpj_donate']; ?>" />
                                        </div>
                                    </div>
                                        
                                        
                                        <div class="col-sm-3">            
                                        <div class="form-group">
                                            <label for="donated_date">Data</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" value="<?php echo sgc_date_format($row['donated_date'], 'd/m/Y'); ?>" OnKeyPress="return sgc_masc_fild(event, this, '##/##/####');"  name="donated_date" id="donated_date" class="form-control pull-right">
                                            </div>
                                        </div>
                                    </div>                                     
                                        
                                    </div>
                                </div>
                                
                                

                            </form>

<?php if($row['id']): ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <form name="img_product">
                                        <div class="form-group">
                                            <label for="arquivo">Enviar imagens</label>
                                            <input type="file" name="arquivo" id="arquivo" class="form-control">
                                            <input type="hidden" name="mod_id" id="mod_id" value="<?php echo $row['id']; ?>" />
                                        </div>       

                                    </form>
                                </div>
                            </div><!--END ROW-->
<?php endif;?>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-sm-12">
                                    <div class="progress mb-2" id="product_b" style="display: none;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="product_p" role="progressbar" style="width: 0%; height: 20px;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>   

                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="button" name="sgc_save" id="sgc_save" onclick="sgc_save_main($(this));" class="btn btn-primary btn_action"><i class="fa fa-check"></i> Salvar</button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" onclick="open_target('target=products', $(this));" class="btn btn-default pull-right rr"> Voltar</button>
                                </div>

                            </div>





                        </div><!--END box body-->







                    </div><!--END PANE CADASTRO -->



                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">

<?php if (count($rows_timeline) == 0): ?>

                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d/m/Y H:i:s') ?></span>

                                        <h3 class="timeline-header"><span style="color: #3c8dbc";>Sistema</span> Este objeto não possui atualizações</h3>


                                    </div>


                                </li>

<?php else: ?>
                                <?php foreach ($rows_timeline as $row_timeline): ?>
                                    <li>
                                    <?php echo $row_timeline['icon'] ?>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo sgc_date_format($row_timeline['created_date'], 'd/m/Y H:i') ?></span>

                                            <h3 class="timeline-header"><span style="color: #3c8dbc";><?php echo $row_timeline['name_user']; ?></span> <?php echo $row_timeline['title']; ?></h3>

                                            <div class="timeline-body">
        <?php echo $row_timeline['content']; ?>
                                            </div>

                                        </div>

                                    </li>

    <?php endforeach; ?>

                            <?php endif; ?>

                        </ul>
                    </div>
                    <!-- END PANE TIMELINE -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->





<?php
$query = "SELECT id,name FROM cap_images_objects WHERE mod_name = 'img_objects' AND object_id = ? AND type = 'imagem'";
$rows_images_objects = conecta()->prepare($query);
$rows_images_objects->execute(array($row['id']));
$rows_images_objects = $rows_images_objects->fetchAll(PDO::FETCH_ASSOC);

if ($row['id'] && count($rows_images_objects) > 0):
    ?>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Imagens</h3>
                    </div>

                    <div class="box-body">


                        <div class="row">
    <?php $x = 1;
    foreach ($rows_images_objects as $row_image): ?>  
  
        <div style="float:left">
            <a href="uploads/imagem/<?php echo $row_image['name']; ?>" rel="shadowbox">
            <div class="profile-user-img img-responsive img-circle imgs_products" style="background-image: url(uploads/imagem/<?php echo $row_image['name']; ?>);"></div>
            </a>
            <button class="btn btn-danger btn-sm" onclick="sgc_toggle('img_<?php echo $row_image['id'] ?>')"><i class="fa fa-trash"></i></button>
            <p id="img_<?php echo $row_image['id'] ?>"style="display:none" class="text-danger text-right"><a href="javasctipt:void(0)" class="text-danger" onclick="sgc_remove_img(<?php echo $row_image['id']; ?>, $(this))"><b>Confirmar exclusão!</b></a></p>
        </div>
        <?php if ($x % 3 == 0 && $x != 1) {
            echo '</div><div class="row">';
        } ?>   

                                <?php $x++;
                            endforeach; ?>
                        </div>



                    </div>

                </div><!-- /.box-body -->

            <?php endif; ?>




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
                                Criado por <br><a><?php echo $row['name_created']; ?></a> em <a><?php echo sgc_date_format($row['created_date'], 'd/m/Y H:i'); ?></a>
                            </li>

                            <?php if ($row['modified_date']): ?>
                                <li class="list-group-item">
                                    Atualizado por<br> <a><?php echo $row['name_modified']; ?></a> em <a><?php echo sgc_date_format($row['modified_date'], 'd/m/Y H:i'); ?></a>
                                </li>     
                            <?php endif; ?>           
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

    $(function () {
        $('.currency').maskMoney({prefix: 'R$ ', allowNegative: true, thousands: '.', decimal: ',', affixesStay: false});

        $('#entry_date').datepicker({
            autoclose: true,
            language: 'br'
        });
        
        
        $('#delivered_date').datepicker({
            autoclose: true,
            language: 'br'
        });
        
        $('#donated_date').datepicker({
            autoclose: true,
            language: 'br'
        });
        
        
    });



    function sgc_save_main(btn) {

        var form = $('form[name="form_main"]');
        var found_location = $('#found_location');
        var status = $('#status');
        var description = $('#description');
        var params = 'target=product&exec=save_product&' + form.serialize();
             

        if (valid_fild('required', description) && valid_fild('required', found_location) && valid_fild('select', status)) {
            open_target(params, btn);
        }
    }

    function sgc_remove_img(id_del, btn) {

        var params = 'target=product&exec=remove_img&id_del=' + id_del + '&id=<?php echo $row['id']; ?>';
        open_target(params, btn);

    }
    
    function sgc_show_input_status(obj){
        
        var status = parseInt(obj.value);
        
        if(status === 2){
            $('.delivered').slideDown('fast');
            $('.donated').slideUp('fast');
        }else if(status === 3){
            $('.donated').slideDown('fast');
            $('.delivered').slideUp('fast');
        }else{
            $('.donated').slideUp('fast');
            $('.delivered').slideUp('fast');
        }
    }


    $('input[type=file]').on("change", function () {

        $(this).each(function (index) {
            if ($('input[type=file]').eq(index).val() != "") {

                var sender = $('form[name="img_product"]');
                var rotina = 'save_img_product';
                var id = $('#mod_id').val();
                send_form_file(sender, 'product', rotina, id);



            }
        });

    });

</script>
