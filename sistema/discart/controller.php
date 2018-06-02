<?php
require_once "../../class/Conexao.php";
require_once "../../class/Categoria.php";
require_once "../../class/Servico.php";
require_once "../../class/Cliente.php";
require_once "../../class/Venda.php";
require_once "../../class/ItensVenda.php";
if(isset($_POST['exe'])){
$post = array();
$post = $_POST;

switch ($post['exe']) {
    case 'fw_save_pending':
    {
        
        $id_venda       = $post['id_venda'];
        $v_pendente     = $post['v_pendente'];
        $v_pago         = $post['v_pago'];

        $v_update = $v_pendente + $v_pago;

       
        $query = "UPDATE venda SET valorPago = $v_update, statusPagamento = 1 WHERE idVenda = $id_venda";
        $ex = conecta()->prepare($query);
        $ex->execute() or die ('-1');
        echo "1";

    }
    
    
    break;
    
    default:
        # code...
    break;
    }
}




/*==============================|OPERAÇÕES RELACIONADAS A CATEGORIA|==================================================*/
if(isset($_POST['novaCategoria'])) {
	/*
		$nome = strip_tags(trim($_POST['nome']));
        $desc = strip_tags(trim($_POST['desc']));
        $cat = new Categoria();
        $cat->inserir($nome, $desc);
    */

        //Novo Metodo
        $cat = new Categoria();
        $tabela = 'categoria';
        $campos = array();
        $id     = '25';
        $campos['nome'] = strip_tags(trim($_POST['nome']));
        $campos['descricaoaa'] = strip_tags(trim($_POST['desc']));

        $ret = $cat->qik_save($tabela, $campos, $id);

        if($ret == 1){
            echo "Ocorreu tudo certo";
        }else{
            echo "Erro ao executar esta operação: ";
        }


}

if(isset($_POST['listar']) && $_POST['listar'] == 'categorias'){
	$cat = new Categoria();
	$cat->listar();
}

if(isset($_POST['deletar'])){
$id = strip_tags(trim($_POST['del']));
//verificando se a categoria está em uso e deletando se não estiver
$checkCategory = new Categoria();
$checkCategory->checkCategory($id);

}

if(isset($_POST['editar'])){
	$cat = new Categoria();
	$cat->busca($_POST['ebusca']);
}

if(isset($_POST['editar_save'])){
	$id			= strip_tags(trim($_POST['idCategoria']));
	$nome 		= strip_tags(trim($_POST['nome']));
	$descricao 	= strip_tags(trim($_POST['descricao']));


    $editCat = new Categoria();
    $editCat->atualizar($nome, $descricao, $id);
}


/*=======================================================|OPERAÇÕES RELACIONADAS A SERVIÇOS|=======================================================*/


if(isset($_POST['Servico']) && $_POST['Servico'] == 'novoServico'){


	$nome = strip_tags(trim($_POST['nome']));
	$categoria = strip_tags(trim($_POST['categoria_idCategoria']));
    $valor = strip_tags(trim($_POST['valor']));
    $descricao = strip_tags(trim($_POST['descricao']));
    
    $novoServico = new Servico();
    $novoServico->inserir($nome, $categoria, $valor, $descricao);    
    
}

if(isset($_POST['listar']) && $_POST['listar'] == 'servicos'){

	$serv = new Servico("x", "y","x","x");
	$serv->listar();
}

if(isset($_POST['deletar']) && $_POST['deletar'] == 'servico'){

$id = strip_tags(trim($_POST['del']));
//verificando se a o serviço está em uso em alguma venda
$checkServico = new Servico("x", "y","x","x");
$checkServico->checkServico($id);
}

//BUSCAR
if(isset($_POST['listarP']) && $_POST['listarP'] == 'searchP'){
$param = strip_tags(trim($_POST['param']));
$serv = new Servico("x", "y","x","x");            
$serv->searchServico($param);


}

if(isset($_POST['populaForm']) && $_POST['populaForm'] == 'servicos'){
	
	$serv = new Servico("x", "y","x","x");
	$serv->busca($_POST['busca']);

	
}

if(isset($_POST['update']) && $_POST['update'] == 'upservico'){
	

	$id				= strip_tags(trim($_POST['idServico']));
	$nome 			= strip_tags(trim($_POST['nome']));
	$descricao 		= strip_tags(trim($_POST['descricao']));
	$valor			= strip_tags(trim($_POST['valor']));
	$idCategoria 	= strip_tags(trim($_POST['categoria_idCategoria']));

	$serv = new Servico();
	$serv->atualizar($nome, $idCategoria, $valor, $descricao,$id);

}

/*===============================================|OPERAÇÕES RELACIONADAS A CLIENTES|=======================================================*/

//LISTAR
if(isset($_POST['listar']) && $_POST['listar'] == 'clientes'){
$client = new Cliente();            
$client->listar();
}

//BUSCAR
if(isset($_POST['listar']) && $_POST['listar'] == 'search'){
$param = strip_tags(trim($_POST['param']));
$client = new Cliente();            
$client->searchCliente($param);
}

//CADASTRAR
if(isset($_POST['Cliente']) && $_POST['Cliente'] == 'novoCliente'){

	

	$nome = strip_tags(trim($_POST['nome']));
    $sexo = strip_tags(trim($_POST['sexo']));
    $nascimento = strip_tags(trim($_POST['nascimento']));
    $nascimento = str_replace("/", "-", $nascimento);
    $nascimento = date('Y-m-d', strtotime($nascimento));
    $telPrincipal = strip_tags(trim($_POST['telPrincipal']));
    $telSecundario = strip_tags(trim($_POST['telSecundario']));
    $cep = strip_tags(trim($_POST['cep']));
    $rua = strip_tags(trim($_POST['rua']));
    $bairro = strip_tags(trim($_POST['bairro']));
    $cidade = strip_tags(trim($_POST['cidade']));
    $uf = strip_tags(trim($_POST['estado']));    
    $cadastradoEm = date("Y-m-d");
    $complemento = strip_tags(trim($_POST['complemento']));
    $numero = strip_tags(trim($_POST['numero']));
             
             
$novoCliente = new Cliente();
$novoCliente->inserir($nome,$sexo, $nascimento, $telPrincipal, $telSecundario, $cep, $rua, $bairro, $cidade, $uf,$complemento,$numero, $cadastradoEm);
             

}

if(isset($_POST['populaForm']) && $_POST['populaForm'] == 'cliente'){
	
	$cliente = new Cliente();
	$cliente->busca($_POST['busca']);

	
}

if(isset($_POST['deleteC']) && $_POST['deleteC'] == 'deletarCliente'){

$id = strip_tags(trim($_POST['del']));
//verificando se a o serviço está em uso em alguma venda
$checkCliente = new Cliente();
$checkCliente->checkSCliente($id);

//fazendo a exclusão efetivamente
$cliente = new Cliente();
$cliente->deletar($id);
}


if(isset($_POST['editar_save_Cliente']) && $_POST['editar_save_Cliente'] == 'editar_save'){


	$id = strip_tags(trim($_POST['idCliente']));
	$nome = strip_tags(trim($_POST['nome']));
    $sexo = strip_tags(trim($_POST['sexo']));
    $nascimento = strip_tags(trim($_POST['nascimento']));
    $nascimento = str_replace("/", "-", $nascimento);
    $nascimento = date('Y-m-d', strtotime($nascimento));
    $telPrincipal = strip_tags(trim($_POST['telPrincipal']));
    $telSecundario = strip_tags(trim($_POST['telSecundario']));
    $cep = strip_tags(trim($_POST['cep']));
    $rua = strip_tags(trim($_POST['rua']));
    $bairro = strip_tags(trim($_POST['bairro']));
    $cidade = strip_tags(trim($_POST['cidade']));
    $estado = strip_tags(trim($_POST['estado']));
    $complemento = strip_tags(trim($_POST['complemento']));
    $numero = strip_tags(trim($_POST['numero']));

    $cliente = new Cliente();
    $cliente->atualizar($nome,$sexo, $nascimento, $telPrincipal, $telSecundario, $cep, $rua, $bairro, $cidade, $estado,$complemento,$numero, $id);


}
/*=====================================================|OPERAÇÕES RELACIONADAS A VENDA|===================================================*/

if(isset($_POST['novaVenda']) && $_POST['novaVenda'] == 'openVenda'){
    
    $dataVenda = strip_tags(trim($_POST['dataVenda']));
    $dataVenda = str_replace("/", "-", $dataVenda);
    $dataVenda = date('Y-m-d', strtotime($dataVenda));    
    $fk_idCliente   = $_POST['fk_idCliente'];
    $fk_idUser      = $_POST['fk_idUser'];

abrirVenda($fk_idUser,$fk_idCliente,$dataVenda);

}

if(isset($_POST['listarAdd']) && $_POST['listarAdd'] == 'servicosAdd'){

    $serv = new Servico("x", "y","x","x");
    $serv->listarAdd();
}

if(isset($_POST['cancel']) && $_POST['cancel'] == 'CancelarVenda'){

    $idVenda = strip_tags(trim($_POST['idVenda']));
    cancelarVenda($idVenda);
    
}

if(isset($_POST['listarVenda']) && $_POST['listarVenda'] == 'listarVendas'){

    $date_start         = $_POST['date_start'];
    $date_end           = $_POST['date_end'];
    listarVendas($date_start,$date_end);

}
if(isset($_POST['popula_modal']) && $_POST['popula_modal'] == 'venda'){
    $idVenda = $_POST['vendaId'];
    popula_modal_venda($_POST['vendaId']);
    
}

if(isset($_POST['update_venda']) && $_POST['update_venda'] == 'valor_pendente'){
    $idVenda = strip_tags(trim($_POST['id_venda']));
    $valor = strip_tags(trim($_POST['valor']));


    update_valor_pendente($idVenda,$valor);

}
/*===============================================|OPERAÇÕES RELACIONADAS ITENS VENDA PROD|==================================================*/

if(isset($_POST['Add']) && $_POST['Add'] == 'AddProd'){

    $quantidade         = strip_tags(trim($_POST['quantidade']));
    $fk_idVenda         = strip_tags(trim($_POST['fk_idVenda']));
    $fk_idServico       = strip_tags(trim($_POST['fk_idServico']));
    $subTotal           = strip_tags(trim($_POST['subTotal']));
    $desc           = strip_tags(trim($_POST['desc']));
    $itensVenda = new ItensVenda();
    $itensVenda->inserir($quantidade, $fk_idVenda, $fk_idServico, $subTotal,$desc);
}

//ITENS VENDA
if(isset($_POST['listarItensVenda']) && $_POST['listarItensVenda'] == 'searchItens'){
    $fk_idVenda = $_POST['param'];
    $itens = new ItensVenda();
    $itens->buscaItensVenda($fk_idVenda);
   
}
//ITENS VENDAF
if(isset($_POST['listarItensVendaF']) && $_POST['listarItensVendaF'] == 'searchItens'){
    $fk_idVenda = $_POST['param'];
    $itens = new ItensVenda();
    $itens->buscaItensVendaF($fk_idVenda);
   
}

if(isset($_POST['deletarServVenda']) && $_POST['deletarServVenda'] == 'deletarSv'){

    $del_id          = strip_tags(trim($_POST['del']));
    $id_Venda        = strip_tags(trim($_POST['delVendaId']));

    $itens = new ItensVenda();
    $itens->delItensVenda($del_id, $id_Venda);

}

if(isset($_POST['vendaAberta']) && $_POST['vendaAberta'] == 'verifica'){
 
 $idUser = strip_tags(trim($_POST['userId']));

  $itens = new ItensVenda();
  $itens->verificaVendaAberta($idUser);


}
if(isset($_POST['salvar']) && $_POST['salvar'] == 'salvarVenda'){
 
 $vendaId = strip_tags(trim($_POST['vendaId']));
 $valor = $_POST['valor'];

 $valorPago = $_POST['valorPago'];
 $statusPagamento = $_POST['statusPagamento'];
 $tipoPagamento = $_POST['tipoPagamento'];
  
  $itens = new ItensVenda();
  $itens->salvarVenda($vendaId,$valor,$valorPago,$statusPagamento,$tipoPagamento);

}
?>