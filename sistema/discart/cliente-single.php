<?php
require_once "../class/Cliente.php";
$listarDados = new Cliente();
$dadosRetorno = $listarDados->buscarDados($_GET['VerEditar']);
foreach ($dadosRetorno as $dados){
        $id = $dados['idCliente'];
        $nome = $dados['nome'];
        $sexo = $dados['sexo'];
        $nascimento = $dados['nascimento'];
        $telPrincipal = $dados['telPrincipal'];
        $telsecundario = $dados['telSecundario'];
        $telsecundario = $dados['telSecundario'];
        $cep = $dados['cep'];
        $rua = $dados['rua'];
        $bairro = $dados['bairro'];
        $cidade = $dados['cidade'];
        $estado = $dados['estado'];
        $mapa = $dados['mapa'];
        $cadastradoEm = $dados['dataCadastro'];
     if(isset($_POST['Editar'])){
         $formedit = "enable";
         $butEstado = "disabled";
     }elseif(!isset($_POST['Editar'])){
         $formedit = "disabled";
         $butEstado = "enable";
     }   
    }
?>
<section class="content-header">
      <h1>
        Cliente
        <small>ID:<strong><?php echo $id?></strong> Criado em <strong><?php echo $cadastradoEm?></strong></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?Menu=Home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Clientes</li>
        <li class="active">ver / editar</li>
      </ol>
    </section>
    <!-- Main content -->   
<section class="content container-fluid">
<?php
if(isset($_GET['Acao']) && $_GET['Acao'] == "Excluir"){
    $x = strip_tags(trim($_GET['VerEditar']));
    $delCliente = new Cliente();
    $delCliente->deletar($x);
}
?>
    <div class="col-sm-7">
        
        <div class="box box-primary">
<?php
if(isset($_POST['Salvar'])){
    $nome = strip_tags(trim($_POST['nome']));
    $sexo = strip_tags(trim($_POST['sexo']));
    $nascimento = strip_tags(trim($_POST['nascimento']));
    $telPrincipal = strip_tags(trim($_POST['telPrincipal']));
    $telSecundario = strip_tags(trim($_POST['telSecundario']));
    $cep = strip_tags(trim($_POST['cep']));
    $rua = strip_tags(trim($_POST['rua']));
    $bairro = strip_tags(trim($_POST['bairro']));
    $cidade = strip_tags(trim($_POST['cidade']));
    $uf = strip_tags(trim($_POST['uf']));
    $mapa = trim($_POST['mapa']);
    $update = new Cliente();
    $update->atualizar($nome, $sexo, $nascimento, $telPrincipal, $telSecundario, $cep, $rua, $bairro, $cidade, $uf, $mapa, $id);
}            
?>
  <form role="form" action="" method="POST" enctype="multipart/form-data">
    <div class="box-body">        
        <div class="col-sm-9">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text"  name="nome" value="<?php echo $nome;?>" <?php echo $formedit;?> autocomplete="off" required class="form-control" id="nome" placeholder="Nome do Cliente">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="nome">Sexo:</label>
                <select name="sexo" class="form-control" <?php echo $formedit;?>>
                    <?php
                    if($sexo == "M"){
                    echo "<option value='F'>F</option>";
                    echo "<option value='M' selected>M</option>";
                    }elseif($sexo == "F"){
                    echo "<option value='F' selected>F</option>";
                    echo "<option value='M'>M</option>";
                    }else{
                    echo "<option value='F'>F</option>";
                    echo "<option value='M'>M</option>";    
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="col-sm-12">
            <div class="form-group">
                <label>Data de Nascimento:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input <?php echo $formedit;?> type="date" value="<?php echo $nascimento;?>" required name="nascimento" class="form-control">
                </div>
            </div>
        </div>
        
        <div class="col-sm-6">           
            <div class="form-group">
                <label>Tel. Principal:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" value="<?php echo $telPrincipal;?>" <?php echo $formedit;?> required class="form-control" name="telPrincipal">
                </div>
            </div>
        </div>
                
        <div class="col-sm-6">
            <div class="form-group">
                <label>Tel. Secundario:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                    </div>
                <input type="text" value="<?php echo $telsecundario;?>" <?php echo $formedit;?> class="form-control"  name="telSecundario">
                </div>
            </div>
        </div>
        
            
        <div class="col-sm-3">
            <div class="form-group">
                <label>Cep:</label>
                <input class="form-control" value="<?php echo $cep;?>" <?php echo $formedit;?> type="text" name="cep" />
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label>Rua:</label>
                <input class="form-control" required type="text" value="<?php echo $rua;?>" <?php echo $formedit;?> placeholder="Rua" name="rua" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Bairro:</label>
                <input class="form-control" required type="text" value="<?php echo $bairro;?>" <?php echo $formedit;?> placeholder="Bairro" name="bairro" />
            </div>
        </div>
        
        <div class="col-sm-9">
            <div class="form-group">
                <label>Cidade:</label>
                <input class="form-control" required type="text" value="<?php echo $cidade;?>" <?php echo $formedit;?> placeholder="Nome da Cidade" name="cidade" />
            </div>
        </div>
        
        <div class="col-sm-3">
            <div class="form-group">
                <label>Estado:</label>
                <input class="form-control" required value="<?php echo $estado;?>" <?php echo $formedit;?> type="text" name="uf" />
            </div>
        </div>
        
        <div class="col-sm-12">
            <div class="form-group">
                <label>Script Mapa:</label>
                <textarea class="form-control" <?php echo $formedit;?> placeholder="Em casso de erro no envio do formulario utilize outro navegador para adicionar este campo." name="mapa"><?php echo $mapa;?></textarea>
            </div>
        </div>
        
</div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="submit" <?php echo $formedit;?> name="Salvar" class="btn btn-primary"><i class="fa fa-check"></i> Salvar</button>
                  <a href="index.php?Menu=Cliente&VerEditar=<?php echo $id;?>&Acao=Excluir"  class="btn btn-danger"><i class="fa fa-remove"></i> Excluir</a>
                  <button type="submit" name="Editar" <?php echo $butEstado;?>  class="btn btn-primary"><i class="fa fa-edit"></i> Habilitar Edição</button>
                  
              </div>
            </form>
        </div><!--FIM DA DIV  BOX PRIMARY-->        
    </div><!--FIM DO BOX QUE CONTROLA O TAMANHO DO FORMULARIO-->
    
    <div class="col-sm-5">
        <div class="box box-primary">
            <?php $listarDados->mapa($mapa);?>
        </div>        
        </div>
    
</section>