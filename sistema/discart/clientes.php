<section class="content-header">
      <h1>
        Clientes
        <small>Adicionar &raquo; Listar &raquo; Editar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?Menu=Home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>
    <!-- Main content -->   
    <section class="content container-fluid">
    
        <div class="col-md-6"><!--DIV COM O FORMULARIO DE INSERIR OU EDITAR CLIENTE DEPENDE DA VARIAVEL Editar-->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Cadastrar Cliente</h3>
              </div>
<form role="form" action="" method="POST" name="cadCliente" enctype="multipart/form-data">
    <div class="box-body">
        
        <div class="col-sm-9">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text"  name="nome" autocomplete="off" required class="form-control" id="nome" placeholder="Nome do Cliente">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="nome">Sexo:</label>
                <select name="sexo" class="form-control">
                    <option value="M">M</option>
                    <option value="F">F</option>
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
                    <input type="text" required name="nascimento" class="form-control pull-right" id="datepicker">
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
<input type="text" required placeholder="(XX)xxxxx-xxxx" class="form-control" name="telPrincipal" OnKeyPress="return mascaraGenerica(event, this, '(##)#####-####');">
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
                <input type="text" class="form-control" placeholder="(XX)xxxxx-xxxx"  name="telSecundario" OnKeyPress="return mascaraGenerica(event, this, '(##)#####-####');">
                </div>
            </div>
        </div>
        
            
        <div class="col-sm-3">
            <div class="form-group">
                <label>Cep:</label>
                <input class="form-control" type="text" id="cep" name="cep" />
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label>Rua:</label>
                <input class="form-control" required type="text" placeholder="Rua" id="rua" name="rua" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Bairro:</label>
                <input class="form-control" required type="text" placeholder="Bairro" id="bairro" name="bairro" />
            </div>
        </div>
        
        <div class="col-sm-10">
            <div class="form-group">
                <label>Complemento:</label>
                <input class="form-control" required type="text" placeholder="Ex: predio, apartamento, andar etc..." id="complemento" name="complemento" />
            </div>
        </div>
        
        <div class="col-sm-2">
            <div class="form-group">
                <label>Numero:</label>
                <input class="form-control" required type="text" id="numero" name="numero" maxlength="6" OnKeyPress="return mascaraGenerica(event, this, '######');"/>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="form-group">
                <label>Cidade:</label>
                <input class="form-control" required type="text" placeholder="Nome da Cidade" id="cidade" name="cidade" />
            </div>
        </div>
        
        <div class="col-sm-3">
            <div class="form-group">
                <label>Estado:</label>
                <input class="form-control" required type="text" id="uf" name="estado" />
            </div>
        </div>
                  
</div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="submit" name="novoCliente" id="novoCliente" class="btn btn-primary"><i class="fa fa-check"></i> Enviar</button>
              </div>
            </form>            
        </div>
            
        </div><!--FIM DA COLUNA-->
        
        <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Clientes Cadastrados</h3>
              </div>

<div class="col-sm-12">
        <form  method="post" name="buscaCliente" id="sc" class="" >
        <div class="input-group">
          <input name="sbusca" class="form-control" id="sbusca" placeholder="Procurar..." type="text" style="background: #FFF !important;">
          <span class="input-group-btn">
              <button type="button" name="search" id="search_btn" class="btn btn-flat btn-info" style="background-color: #00c0ef;"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      </div>
                
               <table class="table table-bordered table-hover dataTable">
                <thead>
                <tr role="row">
                <th class="sorting_desc">ID</th>
                <th class="sorting">Nome</th>
                <th class="sorting">Tel. Principal</th>
                <th class="sorting">Bairro</th>
                <th class="sorting">Ver/Editar</th>
                </tr>
                </thead>
                <tbody id="listaClientes">                      
                
                </tbody>
                <tfoot>
                <tr role="row">
                <th class="sorting_desc">ID</th>
                <th class="sorting">Nome</th>
                <th class="sorting">Tel. Principal</th>
                <th class="sorting">Bairro</th>
                <th class="sorting">Ver/Editar</th>
                </tr>
                </tfoot>
              </table> 
            </div>
        </div>




<div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span id="loadEdit" style="display: none;"><img src="../img/load_b.svg" width="25px"></span>Cliente <strong><span name="nome"></span></strong></h4>
              </div>

              <div class="modal-body">
              <div class="debugEdit" style="display: none;"></div>



            <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><i class='fa fa-eye fa-4' aria-hidden='true'></i> Visão Geral</a></li>
              <li><a href="#tab_2" data-toggle="tab"><i class='fa  fa-edit'></i> Editar</a></li>
              <li><a href="#tab_3" data-toggle="tab" style="color: red !important"><i class='fa  fa-remove'></i> Excluir</a></li>
              
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                
              <div class="row">
                
                <div class="col-md-4">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Último serviço prestado</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              Data: 28/05/2017
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
          <div class="col-md-4">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Collapsable</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              The body of the box
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
          <div class="col-md-4">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Collapsable</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              The body of the box
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>



              </div>
              
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                

<form role="form" action="" method="POST" name="editCliente" enctype="multipart/form-data">
    <div class="box-body">
        
        <div class="col-sm-9">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text"  name="nome" autocomplete="off" required class="form-control getNome" id="nome" placeholder="Nome do Cliente">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="nome">Sexo:</label>
                <select name="sexo" class="form-control">
                    <option value="M">M</option>
                    <option value="F">F</option>
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
                    <input type="text" required name="nascimento" class="form-control pull-right" id="datepickerEdit">
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
<input type="text" required placeholder="(XX)xxxxx-xxxx" class="form-control" name="telPrincipal" OnKeyPress="return mascaraGenerica(event, this, '(##)#####-####');">
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
                <input type="text" class="form-control" placeholder="(XX)xxxxx-xxxx"  name="telSecundario" OnKeyPress="return mascaraGenerica(event, this, '(##)#####-####');">
                </div>
            </div>
        </div>
        
            
        <div class="col-sm-3">
            <div class="form-group">
                <label>Cep:</label>
                <input class="form-control" type="text" id="cep" name="cep" />
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label>Rua:</label>
                <input class="form-control" required type="text" placeholder="Rua" id="rua" name="rua" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Bairro:</label>
                <input class="form-control" required type="text" placeholder="Bairro" id="bairro" name="bairro" />
            </div>
        </div>

        <div class="col-sm-10">
            <div class="form-group">
                <label>Complemento:</label>
                <input class="form-control" required type="text" placeholder="Nome da Cidade" id="complemento" name="complemento" />
            </div>
        </div>
        
        <div class="col-sm-2">
            <div class="form-group">
                <label>Numero:</label>
                <input class="form-control" required type="text" id="numero" name="numero" maxlength="6" OnKeyPress="return mascaraGenerica(event, this, '######');"/>
            </div>
        </div>
        
        <div class="col-sm-9">
            <div class="form-group">
                <label>Cidade:</label>
                <input class="form-control" required type="text" placeholder="Nome da Cidade" id="cidade" name="cidade" />
            </div>
        </div>
        
        <div class="col-sm-3">
            <div class="form-group">
                <label>Estado:</label>
                <input class="form-control" required type="text" id="uf" name="estado" />
                <input type="hidden" name="idCliente" id="idCliente" />
            </div>
        </div>
                  
</div>
              <!-- /.box-body -->
              <div class="box-footer">

                  <button type="submit" name="sendEditCliente" id="sendEditCliente" class="btn btn-primary"><i class="fa fa-check"></i> Enviar</button>
              </div>
            </form>

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="tab_3">
                <p class="text-center"><b>Tem certeza que deseja excluir este cliente?</b></p>

                <div class="row">
                <div class="col-sm-7">
                    <button data-dismiss="modal" class="btn btn-danger form-control closeModalEdit">NAO</button>
                  </div>
                  <div class="col-sm-5">
                    <button data-dismiss="modal" class="btn btn-success form-control j_deleteCliente">SIM</button>
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->


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
<script src="js/alertify/alertify.min.js"></script>
<script type="text/javascript">
      

/*==========================LISTANDO OS CLIENTES =============================================*/
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

function listarClientes(){
  $.ajax({

    data:              'listar=clientes',
    beforeSend: function(){
$('#listaClientes').empty().append('<td colspan="7" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');
    },
    success:              function(resposta){
      $('#listaClientes').empty().append(resposta).fadeIn('slow');
    }



  });//fim do ajax
}//fim da func
listarClientes();

/*==========================LISTANDO OS CLIENTES POR NOME=============================================*/
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

function searchClientes(param){
  $.ajax({

    data:              'listar=search&param='+param,
    beforeSend: function(){
$('#listaClientes').empty().append('<td colspan="7" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');
    },
    success:              function(resposta){
      $('#listaClientes').empty().append(resposta).fadeIn('slow');
    }

  });//fim do ajax
}//fim da func

$('#sbusca').keyup(function(){
var param = $(this).val();

searchClientes(param);

});

$('#sc').submit(function(){
return false;
});

/*======================================CADASTRANDO OS CLIENTES ==========================================*/
  var formulario      = $('form[name="cadCliente"]');
  var botaoEnviar     = $('#novoCliente');
  var debuger         = $('#debuger');
    formulario.submit(function(){
    botaoEnviar.attr('disabled', 'disabled');

    $(this).ajaxSubmit({

      url:                  'sections/controller.php',
      data:                 {Cliente: 'novoCliente'},
      beforeSubmit:         function(){
        botaoEnviar.empty().html('<img src="../img/load_b.svg" width="20px">Carregando...');
      },
      resetForm:        true,
      error:                function(){
          debuger.empty().removeClass('alert-info, alert-dismissible').addClass('alert-danger,alert-dismissible').html('TESTE');
      },
      success:        function(resposta){
        //debuger.html(resposta).fadeIn('slow').delay(1500).fadeOut('fast');
        alertify.success('Cliente cadastrado com sucesso!');
        botaoEnviar.empty().removeAttr('disabled').html('<i class="fa fa-check"></i> Enviar');
        listarClientes();        
      }

    });//fim do ajax subimit
 

  return false; 
  });//fim do submit form



/*===============================|DELETANDO CLIENTE E ATUALIZANDO A LISTA|==================================*/

    $('.j_deleteCliente').click(function(){

        var delid       = $(this).attr("id");
        var deldata     = "deleteC=deletarCliente&del="+delid;//variaveis que serao passadas para o arquivo php
        var liaction    = $('tr[id="j_'+delid+'"]');
        var btnAction   = $('#'+delid);        
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
                alertify.error('Impossivel deletar este cliente pois este registro está em uso no sistema');                
                btnAction.empty().html('<i class="fa  fa-remove"></i>');
                liaction.css({
                'background-color': '#FFF',
                 border: '1px solid #CCC'
                });
              
                }else{
                alertify.success('Cliente excluido com sucesso!');
                liaction.fadeOut("slow");

              
                }
           }            
        });//fim do ajax  
        
    });
/*===============================|EDITANDO SERVICOS E ATUALIZANDO A LISTA|==================================*/

$('#listaClientes').on('click', '.j_edit',function(){
        var editid       = $(this).attr("id");
        var editdata     = "populaForm=cliente&busca="+editid;//variaveis que serao passadas para o arquivo php
        var liaction     = $('tr[id="j_'+editid+'"]');
        var formedit     = $('form[name="editCliente"]');        
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
                 $('span[name="'+key+'"]').text(value);

             });

            $('.j_deleteCliente').attr("id", retorno.idCliente);
 
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

    var formedit      = $('form[name="editCliente"]');
    var loader        = $('#loadEdit');



    formedit.submit(function(){
      $('#sendEditCliente').attr('disabled', 'disabled');
      $('.debugEdit').fadeOut('fast').empty();
    $(this).ajaxSubmit({

      url:                  'sections/controller.php',
      data:                 {editar_save_Cliente: 'editar_save'},
      beforeSubmit:         function(){
        loader.fadeIn('fast');
        $('#sendEditCliente').empty().html('<img src="../img/load_b.svg" width="20px">Carregando...');
      },
      error:                function(){
          
      },
      success:        function(resposta){
        loader.fadeOut('fast');
        $('.debugEdit').fadeIn('fast').html(resposta).delay(1500).fadeOut('fast');
        $('#sendEditCliente').empty().html('<i class="fa fa-check"></i> Enviar');
        $('#sendEditCliente').removeAttr('disabled');
               
      },
      complete:       listarClientes

    });//fim do ajax submit

      return false;
    });



    </script>

<script type="text/javascript">
//Date picker
$('#datepicker').datepicker({
autoclose: true,
format: 'd/m/yyyy',
language: 'pt-br'
});

$('#datepickerEdit').datepicker({
autoclose: true,
format: 'd/m/yyyy',
language: 'pt-br'
});

//MASCARAS DE CAMPO

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

<script type="text/javascript">
  function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...")
                        $("#bairro").val("...")
                        $("#cidade").val("...")
                        $("#uf").val("...")
                        $("#ibge").val("...")

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
</script>



