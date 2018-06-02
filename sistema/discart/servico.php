<?php
require_once "../../class/populaSelect.php";
?>
<section class="content-header">
      <h1>
        Serviços
        <small>Adicionar &raquo; Listar &raquo; Editar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?Menu=Home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Serviços</li>
      </ol>
    </section>
    <!-- Main content -->
   
    <section class="content container-fluid">

        <div class="col-md-5">
            
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Novo Serviço</h3>              
              </div>
            <div id="debuger" style="display: none;"></div>
            <form role="form" name="cadServico" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" name="nome" autocomplete="off" required class="form-control" id="nome" placeholder="Nome do Serviço">
                </div>
                  
                <div class="form-group">
                  <label for="categoria">Categoria:</label>
                  <select class="form-control" name="categoria_idCategoria">
                      <option value="0">Selecione a Categoria...</option>
                      <?php
                      $popule = new populaSelect();
                      $popule->selectCategoria();
                      ?>  
                      </select>
                </div>
                  
                  <div class="form-group">
                  <label for="valor">Valor:</label>
                    <div class="input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" id="valor" placeholder="150.00" name="valor" OnKeyPress="return mascaraGenerica(event, this, '#############')" class="form-control" />
                        
                  </div>
              </div>
                   
            <div class="form-group">
                  <label for="desc">Descrição:</label>
                  <textarea class="form-control" rows="3" required name="descricao" placeholder="Descrição do Serviço"></textarea>
                </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="submit" name="novoServico" id="novoServico" class="btn btn-primary"><i class="fa fa-check"></i> Enviar</button>
              </div>
            </form>            
        </div>
            
            
        </div><!--FIM DA COLUNA-->
        
        <div class="col-md-7">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Servicos Cadastradas</h3>
                </div>
               <table class="table table-bordered table-hover dataTable">
                <thead>
                <tr role="row">
                <th class="sorting_desc">ID</th>
                <th class="sorting">Nome</th>
                <th class="sorting">Categoria</th>
                <th class="sorting">Valor</th>
                <th class="sorting">Descricao</th>
                <th class="sorting">Editar</th>
                <th class="sorting">Deletar</th>
                </tr>
                </thead>
                <tbody id="listaServicos">
                       
                
                </tbody>
                <tfoot>
                <tr role="row">
                <th class="sorting_desc">ID</th>
                <th class="sorting">Nome</th>
                <th class="sorting">Categoria</th>
                <th class="sorting">Valor</th>
                <th class="sorting">Descricao</th>
                <th class="sorting">Editar</th>
                <th class="sorting">Deletar</th>
                </tr>
                </tfoot>
              </table> 
            </div>
        </div>




<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span id="loadEdit" style="display: none;"><img src="../img/load_b.svg" width="25px"></span>Editar serviço</h4>
              </div>

              <div class="modal-body">
              <div class="debugEdit" style="display: none;"></div>                
                <form role="form" name="editServicoForm" id="editServicoForm" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" name="nome" autocomplete="off" required class="form-control" id="nome" placeholder="Nome do Serviço">
                </div>
                  
                <div class="form-group">
                  <label for="categoria">Categoria:</label>
                  <select class="form-control" name="categoria_idCategoria">
                      <option value="0">Selecione a Categoria...</option>
                      <?php
                      $popule = new populaSelect();
                      $popule->selectCategoria();
                      ?>  
                      </select>
                </div>
                  
                  <div class="form-group">
                  <label for="valor">Valor:</label>
                    <div class="input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" id="valor" name="valor" class="form-control" />
                        
                  </div>
              </div>
                   
            <div class="form-group">
                  <label for="desc">Descrição:</label>
                  <textarea class="form-control" rows="3" required name="descricao" placeholder="Descrição do Serviço"></textarea>
                  <input type="hidden" name="idServico" id="idServico ">
                </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="submit" name="novoServico" id="editSend" class="btn btn-primary"><i class="fa fa-check"></i> Enviar</button>
              </div>
            </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right closeModalEdit" data-dismiss="modal">Fechar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


    </section>

<!--<input type="text" name="data" OnKeyPress="return mascaraGenerica(event, this, '##.###.###/####-##');" / >-->
<script src="js/alertify/alertify.min.js"></script>
<script language="JavaScript" type="text/javascript">


/*==========================LISTANDO OS SERVIÇOS =============================================*/
  var urlPost = 'sections/controller.php';
  
  $.ajaxSetup({
  type:   'POST',
  url:    urlPost,
  beforeSend: function(){

  },
  error:    function(){
    alert('ERRO INESPERADO AÇÃO NÃO CONCLUIDA');
  }  
  }); 

function listarServ(){
  $.ajax({

    data:              'listar=servicos',
    beforeSend: function(){
$('#listaServicos').empty().append('<td colspan="7" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');
    },
    success:              function(resposta){
      $('#listaServicos').empty().append(resposta).fadeIn('slow');
    }



  });//fim do ajax
}//fim da func
listarServ();

/*======================================CADASTRANDO AS SERVICOS ==========================================*/
  var formulario      = $('form[name="cadServico"]');
  var botaoEnviar     = $('#novoServico');
  var debuger         = $('#debuger');
    formulario.submit(function(){
    botaoEnviar.attr('disabled', 'disabled');

    $(this).ajaxSubmit({

      url:                  'sections/controller.php',
      data:                 {Servico: 'novoServico'},
      beforeSubmit:         function(){
        botaoEnviar.empty().html('<img src="../img/load_b.svg" width="20px">Carregando...');
      },
      resetForm:        true,
      error:                function(){
          debuger.empty().removeClass('alert-info, alert-dismissible').addClass('alert-danger,alert-dismissible').html('TESTE');
      },
      success:        function(resposta){
        //debuger.html(resposta).fadeIn('slow').delay(1500).fadeOut('fast');
        alertify.success('Serviço cadastrado com sucesso!');
        botaoEnviar.empty().removeAttr('disabled').html('<i class="fa fa-check"></i> Enviar');
        listarServ();        
      }

    });//fim do ajax subimit
 

  return false; 
  });//fim do submit form


 /*===============================|DELETANDO Serviços E ATUALIZANDO A LISTA|==================================*/
    $('#listaServicos').on('click', '.j_delete',function(){

        var delid       = $(this).attr("id");
        var deldata     = "deletar=servico&del="+delid;//variaveis que serao passadas para o arquivo php
        var liaction    = $('tr[id="j_'+delid+'"]');
        var btnAction   = $('.j_action'+delid);        
        liaction.css({
                'background-color': '#f7c6c6',
                 border: '1px solid red'
                });
         
        
        $.ajax({
           data:        deldata,
           beforeSend:  function(){
               btnAction.empty().html('<img src="../img/load_b.svg" width="20px">');
           },
           error:       '',
           success: function (x){

                if(x > 0){
                alertify.error('Impossivel deletar este serviço pois ele já está em uso no sistema');
                btnAction.empty().html('<i class="fa  fa-remove"></i>');
                liaction.css({
                'background-color': '#FFF',
                 border: '1px solid #CCC'
                });

                }else{
                alertify.success('Serviço deletado com sucesso!');
                liaction.fadeOut("slow");

                }
           }            
        });//fim do ajax  
        
    });

/*===============================|EDITANDO SERVICOS E ATUALIZANDO A LISTA|==================================*/

$('#listaServicos').on('click', '.j_edit',function(){
        var editid       = $(this).attr("id");
        var editdata     = "populaForm=servicos&busca="+editid;//variaveis que serao passadas para o arquivo php
        var liaction     = $('tr[id="j_'+editid+'"]');
        var formedit     = $('form[name="editServicoForm"]');        
        liaction.css({
                'background-color': 'rgb(90, 167, 251)',
                 border: '1px solid green'
                });

        $.ajax({

           data:        editdata,
           dataType:      'json',
           beforeSend:  function(){
               $('#loadEdit').fadeIn('fast');
               formedit.fadeOut('fast');
           },
           error: function (request, status, erro) {
            alert("Problema ocorrido: " + status + "\nDescição: " + erro);
            //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
            alert("Informações da requisição: \n" + request.getAllResponseHeaders());
        },
           success:       function(retorno){
             $.each(retorno,function(key, value){
                 formedit.fadeIn('slow').find("input[name='"+key+"'], textarea[name='"+key+"'], select[name='"+key+"']").val(value);
                 
                 $('#loadEdit').fadeOut('fast');


             });
         }

        });//fim do ajax
  


$('.closeModalEdit').click(function(){
    liaction.css({
                'background-color': '#FFF',
                 border: '1px solid #CCC'
                });

    $('.debugEdit').empty().fadeOut();

    
});//FIM DO CLOSE MODAL

});//fim do botão edit

/*==============================================================|REALIZANDO EDIÇÃO|==================================================*/

    var formedit      = $('form[name="editServicoForm"]');
    var loader        = $('#loadEdit');



    formedit.submit(function(){
      $('#editSend').attr('disabled', 'disabled');
      $('.debugEdit').fadeOut('fast').empty();
    $(this).ajaxSubmit({

      url:                  'sections/controller.php',
      data:                 {update: 'upservico'},
      beforeSubmit:         function(){
        loader.fadeIn('fast');
        $('#editSend').empty().html('<img src="../img/load_b.svg" width="20px">Carregando...');
      },
      error:                function(){
          
      },
      success:        function(resposta){
        loader.fadeOut('fast');
        $('.debugEdit').fadeIn('fast').html(resposta).delay(1500).fadeOut('fast');
        $('#editSend').empty().html('<i class="fa fa-check"></i> Enviar');
        $('#editSend').removeAttr('disabled');        
        
      },
      complete:       listarServ

    });//fim do ajax submit

      return false;
    });






      function mascaraGenerica(evt, campo, padrao) {  
           //testa a tecla pressionada pelo usuario  
           var charCode = (evt.which) ? evt.which : evt.keyCode;  
           if (charCode == 8) return true; //tecla backspace permitida  
           if (charCode != 46 && (charCode < 48 || charCode > 57)) return false; //apenas numeros            
           campo.maxLength = padrao.length; //Define dinamicamente o tamanho maximo do campo de acordo com o padrao fornecido  
           //aplica a mascara de acordo com o padrao fornecido  
           entrada = campo.value;  
           if (padrao.length > entrada.length && padrao.charAt(entrada.length) != '#') {  
                campo.value = entrada + padrao.charAt(entrada.length);                 
           }  
           return true;  
      }  
 </script>  