<?php
require_once "../../class/populaSelect.php";
require_once "../../class/Sessao.php";
require_once "../../class/Conexao.php";
@$on = new Sessao();

?>
<section class="content-header">
      <h1>
        Serviços
        <small>Lançado por: <strong><?php echo $on->getNome();?></strong> </strong> em <strong><?php echo $data = date("d/m/Y");?></strong></small>
        <input type="hidden" name="idUserOn" id="idUserOn" value="<?php echo $on->getIdUser();?>" />
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?Menu=Home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lançar Serviço</li>
      </ol>
    </section>
    <!-- Main content -->
   
<section class="content container-fluid">
 
<!-- AREA CHART ABRE VENDA -->
          <div class="box box-primary" id="lancarVenda" style="display: none;"> 
            <div class="box-header with-border">
                <h3 class="box-title">Lançar Servico</h3>
                </div>             
            
            <div class="box-body">

                  <form enctype="multipart/form-data" id="abrindoVenda" name="abrindoVenda" method="POST" action="">
                                             
                    <div class="row">
                      <div class="col-sm-8">
                          <div class="form-group">                         
                          
                              <label>Cliente: </label>
                              <select name="fk_idCliente" disable="enabled" id="fk_idCliente" class="form-control">
                                  <option value="0">Selecione...</option> 
                               <?php
                                  $select = new populaSelect();
                                  $select->selectCliente();
                              ?>                                 
                              </select>                               
                          </div><!--select-->
                          </div>                      
                      <div class="col-sm-2">

                          <div class="form-group">
                              <label>Data: </label>
                              <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datavenda" name="dataVenda" id="datepicker">
                  <input type="hidden" name="fk_idUser" id="fk_idUser" value="<?php echo $on->getIdUser();?>">
                </div>
                              
                          </div>
                      </div><!--data-->

                      <div class="col-sm-2">
                           <div class="form-group">
                               <label id="lb_open">Lançar</label>
                               <button type="submit" id="abrirVenda" name="clienteOK" class="btn btn-info form-control"><i class="fa fa-check"></i></button>
                          </div>
                       </div><!-- /.form-group --> 
                      </div><!--row-->                     
            </form>
                  
          
            </div>            

</div>



</div><!--FIM DO CONTENT 12-->


<div class="box box-primary" id="dadosVenda" style="display: none;">
  <div class="box-header with-border">
                <h3 class="box-title">Lançamento de Serviço em aberto</h3>
              </div>
  <div class="box-body">
    <div class="row">
  
      <div class="col-sm-9">
  <p>ID: <span class="idVenda" id="idVenda"></span> Aberto por: <span id="user"></span> Cliente: <span id="cliente"><strong></strong></span> Data: <span id="data"><strong>18/05/2017</strong></span></p>
  
        <input type="hidden" name="idVenda" id="idVenda" value=""></input>
      </div>

      <div class="col-sm-3">
        <button class="btn btn-danger form-control cancelarVenda" id=""><i class="fa fa-times" aria-hidden="true"></i>
        Cançelar Venda</button>
      </div>

    </div>
  </div>
</div>

<div class="row">

<div class="col-sm-7">
  <div class="box box-primary" id="listaProdutos" style="display: none;">
    <div class="box-header with-border">
                <h3 class="box-title">Selecione os serviços</h3>
      </div>
    <div class="box-body">
    <div class="col-sm-12">
        <form  method="post" name="buscaCliente" id="sc" class="">
        <div class="input-group">
          <input name="sbuscaServ" class="form-control" id="sbuscaServ" placeholder="Procurar..." type="text" style="background: #FFF !important;">
          <span class="input-group-btn">
              <button type="button" name="search" id="search_btn" class="btn btn-flat btn-info"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      </div>
                
               <table class="table table-bordered table-hover">
                <thead>
                <tr role="row">
                <th class="sorting">Nome</th>
                <th class="sorting">Categoria</th>
                <th class="sorting">Valor</th>
                <th class="sorting">Desconto</th>
                <th class="sorting">Quantidade</th>
                <th class="sorting">Descrição</th>
                <th class="sorting">Adicionar</th>
                </tr>
                </thead>
                <tbody id="listaServicos">                      
                
                </tbody>
                <tfoot>
                <tr role="row">
                <th class="sorting">Nome</th>
                <th class="sorting">Categoria</th>
                <th class="sorting">Valor</th>
                <th class="sorting">Desconto</th>
                <th class="sorting">Quantidade</th>
                <th class="sorting">Descrição</th>
                <th class="sorting">Adicionar</th>
                </tr>
                </tfoot>
              </table>
    </div>
  </div>
</div><!--FIM DO COL-SM-9-->


<div class="col-sm-5">
  <div class="box box-primary" id="infoVenda" style="display: none;">
    <div class="box-header with-border">
                <h3 class="box-title">Venda</h3>
      </div>
    <div class="box-body">
    <table class="table table-sm table-hover">
  <thead>
    <tr class="">
      <th scope="col">Qtd</th>
      <th scope="col">Produto</th>
      <th scope="col">Sub Total</th>
      <th scope="col">Desconto</th>
      <th scope="col">Remover</th>
    </tr>
  </thead>
  <tbody id="listaItensVenda">
    <tr>
      

    </tr>        
  </tbody>
</table>


<div class="row">

<div class="col-md-7">
<p class="pgsub" style="text-align: center;height: 34px;">Sub Total R$ <span class="totalSub"></span></p>
</div>

<div class="col-md-5">
<p class="pgdesc" style="text-align: center;height: 34px;">Descontos R$ <span class="totalDesc"></span></p>
</div>

</div>

<div class="row">
<div class="col-sm-12">
<p id="total" style="height: 34px;" class="text-center pgVenda">TOTAL R$ <span class="total"></span></p>
</div>
</div>

<div class="row" style="margin-bottom: 10px;">

<div class="col-sm-6">
<label for="valorPago">Valor Pago</label>
<div class="input-group">
                <span class="input-group-addon">R$</span>
                <input name="valorPago" id="valorPago" class="form-control" type="text">

              </div>
</div>


<div class="col-sm-6">
<label for="formaPgmt">Forma de pagamento</label>

<select class="form-control" name="tipoPagamento" class="tipoPagamento">
                    <option value="0">--Selecione--</option>                    
                      <?php
                        $select = new populaSelect();
                        $select->populaFormaPagamento();
                      ?>
                    
                  </select>

</div>

</div>

<div class="row">
<div class="col-sm-4">
<button class="btn btn-danger form-control cancelar" id=""><i class="fa fa-times" aria-hidden="true"></i>
        Cançelar</button>
</div>
<div class="col-sm-8">
<button class="btn btn-info form-control salvarVenda" id="" style=""><i class="fa fa-check"></i>
        Salvar</button>
</div>
</div>



    </div>
  </div>
</div><!--FIM DO COL-SM-9-->
</div><!--FIM DA LINHA DE PRODUTOS E INFO VENDA-->
</section><!--FIM DA SESSAO-->
<script src="js/alertify/alertify.min.js"></script>


<script type="text/javascript">
function reset () {
      $("#toggleCSS").attr("href", "css/alertify/alertify.default.css");
      alertify.set({
        labels : {
          ok     : "SIM",
          cancel : "NÂO"
        },
        delay : 5000,
        buttonReverse : false,
        buttonFocus   : "ok"
      });
    }

    // ==============================

//window.setTimeout(verificaVendaAberta, 500);
verificaVendaAberta();
/*======================================CADASTRANDO AS venda ==========================================*/
    var botaoEnviar   = $('#abrirVenda');
    var formulario    = $('form[id="abrindoVenda"]');

    formulario.submit(function(){
      if($('#fk_idCliente').val() != 0){

    botaoEnviar.attr('disabled', 'disabled');

    $(this).ajaxSubmit({

      url:                  'sections/controller.php',
      data:                 {novaVenda: 'openVenda'},
      dataType:             "json",
      beforeSubmit:         function(){
        botaoEnviar.empty().html('<img src="../img/load_b.svg" width="20px">Carregando...');
      },      
      error:                function(){
          alert('erro ao salvar')
      },
      success:        function(resposta){
        
        botaoEnviar.empty().removeAttr('disabled').html('<i class="fa fa-check"></i> Enviar');
        $('#user').empty().html(resposta.nomeUsuario);
        $('#cliente').empty().html(resposta.nomeCliente);
        $('#data').empty().html(resposta.dataVenda);
        $('#idVenda').val(resposta.idVenda);
        $('.cancelarVenda').attr('id', resposta.idVenda);
        $('#lancarVenda').fadeOut('slow', function(){
        $('#dadosVenda').fadeIn('slow');
        $('.idVenda').text(resposta.idVenda);
        $('.idVenda').attr('id', resposta.idVenda);

        $('#listaProdutos').fadeIn('slow');
        
        });       
                
      }

    });//fim do ajax subimit

  }else{
    alert('Selecione um Cliente');
  }
 

  return false; 
  });//fim do submit form

/*==========================LISTANDO OS SERVIÇOS =============================================*/
  var urlPost = 'sections/controller.php';
  
  $.ajaxSetup({
  type:   'POST',
  url:    urlPost,
  beforeSend: function(){

  },
  error:    function(){
    //alert('ERRO INESPERADO AÇÃO NÃO CONCLUIDA');
  }  
  }); 

function listarServAdd(){
  $.ajax({

    data:              'listarAdd=servicosAdd',
    beforeSend: function(){
$('#listaServicos').empty().append('<td colspan="7" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');
    },
    success:              function(resposta){
      $('#listaServicos').empty().append(resposta).fadeIn('slow');
      
    }



  });//fim do ajax
}//fim da func
listarServAdd();



/*===============================|Adicionando Serviços E ATUALIZANDO A LISTA|==================================*/
    $('#listaServicos').on('click', '.j_AddServ',function(){

        var Addid           = $(this).attr("id");
        var qtd             = $('#qtd'+Addid+'').val();
        var desc            = $('#desc'+Addid+'').val();
        desc = desc.replace(',','.');        
        var liaction        = $('tr[id="j_'+Addid+'"]');
        var btnAction       = $('.j_AddProd'+Addid);
        var idVendaP        = $('.idVenda').attr('id');
        var sub             = $('.subValor'+Addid+'').attr('id');
        var subProd         = sub*qtd;
        var Adddata         = "Add=AddProd&fk_idVenda="+idVendaP+"&quantidade="+qtd+"&fk_idServico="+Addid+"&subTotal="+subProd+"&desc="+desc;//variaveis que serao 
        if(qtd != '' && qtd > 0){     
        liaction.css({
                'background-color': '#7fc3fb',
                 border: '1px solid blue'
                });
        
        $.ajax({
           url:        'sections/controller.php',
           data:        Adddata,
           beforeSend:  function(){
               btnAction.empty().html('<img src="../img/load_b.svg" width="20px">');
               btnAction.attr("disabled", "disabled");
           },
           error:       '',
           success: function (x){
                
                //liaction.fadeOut('fast');
                liaction.css('background-color', 'rgb(127, 251, 128)');
                btnAction.empty().html('<i class="fa fa-plus" aria-hidden="true"></i>');
                $('#infoVenda').fadeIn('slow');
                btnAction.removeAttr("disabled");
                reset();
                alertify.success("Novo produto adicionado");
                searchItensVenda(idVendaP);
                searchItensVendaF(idVendaP);

                //alert(x);
           }         
        });//fim do ajax 

      }else{
        alert('A quantidade do serviço selecionado deve ser maior que 0');
      }
        
        
    });
//=================================================busca form ===============================

function searchProdutos(param){
  $.ajax({

    data:              'listarP=searchP&param='+param,
    beforeSend: function(){
$('#listaServicos').empty().append('<td colspan="7" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');
    },
    success:              function(resposta){
      $('#listaServicos').empty().append(resposta).fadeIn('slow');
    }

  });//fim do ajax
}//fim da func

$('#sbuscaServ').keyup(function(){
var param = $(this).val();

searchProdutos(param);

});

//============================|buscando itens venda|=============================
function searchItensVenda(param){
  $.ajax({
    url:                'sections/controller.php',
    data:              'listarItensVenda=searchItens&param='+param,    
    beforeSend: function(){
//$('#listaItensVenda').empty().append('<td colspan="4" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');
    },
    success:              function(resposta){
      //alert(resposta);
      $('#listaItensVenda').empty().append(resposta).fadeIn('slow');
    }

  });//fim do ajax
}//fim da func

function searchItensVendaF(param){
  $.ajax({
    url:               'sections/controller.php',
    dataType:          'json',
    data:              'listarItensVendaF=searchItens&param='+param,    
    beforeSend: function(){
//$('#listaItensVenda').empty().append('<td colspan="4" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');
    },
    success:              function(resposta){
      $('.totalSub').attr('id', resposta.totalSub);
      $('.totalDesc').attr('id', resposta.totalDesc);
      $('.total').attr('id', resposta.total);
      $('.salvarVenda').attr('id', resposta.idVenda);
      $('.cancelar').attr('id', resposta.idVenda);

      $('.totalSub').text(resposta.totalSub);
      $('.totalDesc').text(resposta.totalDesc);
      $('.total').text(resposta.total);
      //$('#listaItensVenda').empty().append(resposta).fadeIn('slow');
    }

  });//fim do ajax
}//fim da func

/*===============================|DELETANDO SERVIÇO DA LISTA E ATUALIZANDO A LISTA|==================================*/
    $('#listaItensVenda').on('click', '.j_delete',function(){

        var delid       = $(this).attr("id");
        var vendaid     = $('.idVenda').attr('id');
        var deldata     = "deletarServVenda=deletarSv&del="+delid+"&delVendaId="+vendaid;//variaveis que serao passadas para o arquivo php
        var liaction    = $('tr[id="j_'+delid+'"]');
        var btnAction   = $('.j_action'+delid);
                
        liaction.css({
                'background-color': '#f7c6c6',
                 border: '1px solid red'
                });
         
        
        $.ajax({
          url:                'sections/controller.php',
           data:        deldata,
           beforeSend:  function(){
               btnAction.empty().html('<img src="../img/load_b.svg" width="20px">');
           },
           error:       function(x){
            alert(x);
           },
           success: function (x){
                alertify.success('Item removido com sucesso!');
                liaction.fadeOut("slow");                
                searchItensVenda(vendaid);
                searchItensVendaF(vendaid);
                
           }            
        });//fim do ajax  
       
    });

//  CARREGANDO VENDA ABERTA

function verificaVendaAberta(){

  var param = $('#idUserOn').val();
  $('.cancelarVenda').empty().html('<i class="fa fa-times" aria-hidden="true"></i> Cançelar Venda');
  $.ajax({
    url:                'sections/controller.php',
    data:              'vendaAberta=verifica&userId='+param,
    dataType:           'json',
    error:          function(x){
           $.each(x,function(key, value){
            alert(value);
           })
           },   
    beforeSend: function(){

    },
    success:              function(resposta){
      if(resposta.resp == 1){
          $('#lancarVenda').fadeOut('slow');
          $('#dadosVenda').fadeIn('slow');
          searchItensVenda(resposta.idVenda);
          searchItensVendaF(resposta.idVenda);
          $('#infoVenda').fadeIn('slow');
          $('.idVenda').text(resposta.idVenda);
          $('.idVenda').attr('id', resposta.idVenda);
          $('#idVenda').val(resposta.idVenda);
          $('#cliente').text(resposta.nome);
          $('#user').text(resposta.nomeUser);
          $('#data').empty().text(resposta.dataVenda);
          $('.cancelarVenda').attr('id', resposta.idVenda);
          $('#listaProdutos').fadeIn('slow');

      }else if(resposta.resp == -1){
        $('#dadosVenda').fadeOut('fast');
        $('#listaProdutos').fadeOut('fast');
        $('#infoVenda').fadeOut('fast');
        $('#lancarVenda').fadeIn();

      }
    }

  });//fim do ajax
}//fim da func
//===================================|Salvar Venda|==============================================//

$('#infoVenda').on('click', '.salvarVenda',function(){
reset();
  alertify.set({ buttonReverse: true });
  alertify.confirm("Deseja salvar venda?", function (e) {
  if (e) {
  var idVenda           = $('.salvarVenda').attr('id');
  var valor             = $('.total').attr('id');
  var valorPago         = $('input[name="valorPago"]').val();
      valorPago = valorPago.replace(',','.');
  var statusPagamento;
  var tipoPagamento     =$('select[name="tipoPagamento"]').val();

  if(valorPago == valor){
    statusPagamento = 1;//pago
  }else if(valorPago == 0){
    statusPagamento = 3; //pendente
  }else{
  statusPagamento = 2;//parcialmente pago
  }

  //alert('venda: '+idVenda+' Valor: '+valor+' ValorPago: '+valorPago+' statusPagamento: '+statusPagamento+' tipoPagamento '+tipoPagamento); 

  $.ajax({
    url:                'sections/controller.php',
data:      'salvar=salvarVenda&vendaId='+idVenda+'&valor='+valor+'&valorPago='+valorPago+'&statusPagamento='+statusPagamento+'&tipoPagamento='+tipoPagamento,
    beforeSend:          function(){
      $('.salvarVenda').empty().html('<img src="../img/load_b.svg" width="20px"> Salvando');
    },
    error:              function(x){
      reset();
      alertify.error(x);
    },
    success:            function(){      
      $('#infoVenda').fadeOut('fast');
      $('#listaProdutos').fadeOut('fast');      
      $('#dadosVenda').fadeOut('fast');
      $('#lancarVenda').fadeIn('fast');
      $('.salvarVenda').empty().html('<i class="fa fa-check"></i>Salvar');
      reset();
      alertify.success("Venda salva com sucesso!");
      verificaVendaAberta();

    }
  });

        } else {
          alertify.error("Ação cançelada");
        }
      });
      return false;



  
});

//==============================|Cançelando venda|==========================================
$('#dadosVenda').on('click', '.cancelarVenda', function(){

  reset();
  alertify.set({ buttonReverse: true });
  alertify.confirm("Deseja Cancelar esta venda?", function (e) {
  if (e) {

  var idVenda       = $('.cancelarVenda').attr('id');
  var btnAction     = $('.cancelarVenda');
  var cancelData    = 'cancel=CancelarVenda&idVenda='+idVenda;
  
  $.ajax({

    url:          'sections/controller.php',
    data:         cancelData,
    beforeSend:   function(){
      btnAction.empty().html('<img src="../img/load_b.svg" width="20px">Cançelando...');
    },
    error:        function(x){
      reset();
      alertify.error(x); 
    },
    success:     function(resposta){
      btnAction.empty().html('Venda Cancelada!');
      reset();
      alertify.success("Venda cançelada com sucesso!");       
      verificaVendaAberta();
    }

  });//fim do ajax

  } else {
          alertify.error("Ação cançelada");
        }
      });
      return false;
});
//==============================Cancelando a venda 2===================
$('#infoVenda').on('click', '.cancelar',function(){

reset();
  alertify.set({ buttonReverse: true });
  alertify.confirm("Deseja Cancelar esta venda?", function (e) {
  if (e) {

  var idVenda       = $('.cancelar').attr('id');
  var btnAction     = $('.cancelar');
  var cancelData    = 'cancel=CancelarVenda&idVenda='+idVenda;
  
  $.ajax({

    url:          'sections/controller.php',
    data:         cancelData,
    beforeSend:   function(){
      btnAction.empty().html('<img src="../img/load_b.svg" width="20px">Cançelando');
    },
    error:        function(x){
      reset();
      alertify.error(x); 
    },
    success:     function(resposta){
      btnAction.empty().html('Venda Cancelada!');
      reset();
      alertify.success("Venda cançelada com sucesso!");       
      verificaVendaAberta();
    }

  });//fim do ajax

  } else {
          alertify.error("Ação cançelada");
        }
      });
      return false;
});




  //=========================================================

//Date picker
$('#datepicker').datepicker({
                                
autoclose: true,
format: 'd/m/yyyy',
language:    'pt-BR'
});
</script>