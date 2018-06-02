<section class="content-header">
      <h1>
        Categoria
        <small>Adicionar &raquo; Listar &raquo; Editar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?Menu=Home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categoria</li>
      </ol>
    </section>
    <!-- Main content -->
   
    <section class="content container-fluid">

        <div class="col-md-5">
            
            <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Nova Categoria</h3> 
            </div>
              <div id="debuger" style="display: none;"> </div>
            
            <form role="form" name="newCagoriesForm" action="" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" name="nome" autocomplete="off" required class="form-control" id="nome" placeholder="Nome da Categoria">
                </div>
                <div class="form-group">
                  <label for="desc">Descrição:</label>
                  <textarea class="form-control" rows="3" required name="desc" placeholder="Descrição da Categoria"></textarea>
                </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="submit" id="novaCategoria" class="btn btn-primary"><i class="fa fa-check"></i> Enviar</button>
                  <button class="btn btn-default">Testar chamada de função</button>
              </div>
            </form>

        </div>
            
        </div><!--FIM DA COLUNA-->
        
        <div class="col-md-7">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Categorias Cadastradas</h3>
               </div> 
               <table class="table table-bordered table-hover dataTable">
                <thead>
                <tr role="row">
                <th class="sorting_desc">ID</th>
                <th class="sorting">Categoria</th>
                <th class="sorting">Descricao</th>
                <th class="sorting">Editar</th>
                <th class="sorting">Deletar</th>
                </tr>
                </thead>
                <tbody id="listaCategorias">
                     
                
                </tbody>
                <tfoot>
                <tr role="row">
                <th class="sorting_desc">ID</th>
                <th class="sorting">Categoria</th>
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
                <h4 class="modal-title"><span id="loadEdit" style="display: none;"><img src="../img/load_b.svg" width="25px"></span>Editar Categoria</h4>
              </div>

              <div class="modal-body">
              <div class="debugEdit" style="display: none;"></div>                
                <form role="form" name="editarcategoriaForm" action="" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" name="nome" autocomplete="off" required class="form-control" id="nome" placeholder="Nome da Categoria">
                </div>
                <div class="form-group">
                  <label for="desc">Descrição:</label>
                  <textarea class="form-control" rows="3" required name="descricao" id="descricao" placeholder="Descrição da Categoria"></textarea>
                  <input type="hidden" name="idCategoria"/>
                </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="submit" id="editSend" class="btn btn-primary"><i class="fa fa-check"></i> Enviar</button>
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

<script type="text/javascript">
  

  var formulario    = $('form[name="newCagoriesForm"]');
  var botaoEnviar   = $('#novaCategoria');
  var debuger       = $('#debuger');
  var urlPost       = 'sections/controller.php';

/*==========================LISTANDO AS CATEGORIAS =============================================*/
  $.ajaxSetup({
  type:   'POST',
  url:    urlPost,
  beforeSend: function(){

  },
  error:    function(x){
    alert(x);
  }  
  }); 

function listarcat(){
  $.ajax({
    url:                   'sections/controller.php',
    data:                  'listar=categorias',
    beforeSend: function(){
$('#listaCategorias').empty().append('<td colspan="5" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');
    },
    error:                function(x){
      alert(x);
    },
    success:              function(resposta){
      $('#listaCategorias').empty().append(resposta).fadeIn('slow');      

    }



  });//fim do ajax
}//fim da func
listarcat();
/*======================================CADASTRANDO AS CATEGORIAS ==========================================*/

  formulario.submit(function(){
    botaoEnviar.attr('disabled', 'disabled');

    $(this).ajaxSubmit({

      url:                  'sections/controller.php',
      data:                 {novaCategoria: 'novaCategoria'},
      beforeSubmit:         function(){
        botaoEnviar.empty().html('<img src="../img/load_b.svg" width="20px">Carregando...');
      },
      resetForm:        true,
      error:                function(x){
          debuger.empty().removeClass('alert-info, alert-dismissible').addClass('alert-danger,alert-dismissible').html(x);
      },
      success:        function(resposta){
        //debuger.html(resposta).fadeIn('slow').delay(1500).fadeOut('fast');
        alertify.success('Categoria cadastrada com sucesso!');
        botaoEnviar.empty().removeAttr('disabled').html('<i class="fa fa-check"></i> Enviar');
        alert(resposta);
        listarcat();        
      }

    });//fim do ajax subimit
 

  return false; 
  });//fim do submit form


  /*===============================|DELETANDO CATEGORIA E ATUALIZANDO A LISTA|==================================*/
    $('#listaCategorias').on('click', '.j_delete',function(){

        var delid       = $(this).attr("id");
        var deldata     = "deletar=deletar&del="+delid;//variaveis que serao passadas para o arquivo php
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
           error:       function(x){
            alert(x);
           },
           success: function (x){
                if(x > 0){
                alertify.error('Impossivel deletar esta categoria pois ela já está em uso no sistema.');
                btnAction.empty().html('<i class="fa  fa-remove"></i>');
                liaction.css({
                'background-color': '#FFF',
                 border: '1px solid #CCC'
                });
                }else{                
                alertify.success('Categoria Excluida com sucesso!');
                liaction.fadeOut("slow");
                }
           }            
        });//fim do ajax  
        
    });


/*===============================|EDITANDO categorias E ATUALIZANDO A LISTA|==================================*/

$('#listaCategorias').on('click', '.j_edit',function(){
        var editid       = $(this).attr("id");
        var editdata     = "editar=editar&ebusca="+editid;//variaveis que serao passadas para o arquivo php
        var liaction     = $('tr[id="j_'+editid+'"]');
        var formedit     = $('form[name="editarcategoriaForm"]');        
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
           error:          function(x){
           $.each(x,function(key, value){
            alert(value);
           })
           },
           success:       function(retorno){
             $.each(retorno,function(key, value){
                 formedit.fadeIn('slow').find("input[name='"+key+"']").val(value);
                 formedit.fadeIn('slow').find("textarea[name='"+key+"']").val(value);
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

    var formedit      = $('form[name="editarcategoriaForm"]');
    var loader        = $('#loadEdit');



    formedit.submit(function(){
      $('#editSend').attr('disabled', 'disabled');
      $('.debugEdit').fadeOut('fast').empty();
    $(this).ajaxSubmit({

      url:                  'sections/controller.php',
      data:                 {editar_save: 'editar_save'},
      beforeSubmit:         function(){
        loader.fadeIn('fast');
        $('#editSend').empty().html('<img src="../img/load_b.svg" width="20px">Carregando...');
      },
      error:                function(x){
          alert(x);
      },
      success:        function(resposta){
        loader.fadeOut('fast');
        $('.debugEdit').fadeIn('fast').html(resposta).delay(1500).fadeOut('fast');
        $('#editSend').empty().html('<i class="fa fa-check"></i> Enviar');
        $('#editSend').removeAttr('disabled');        
      },
      complete:       listarcat

    });//fim do ajax submit

      return false;
    });



function nova_cat_func(){

  $('textarea[name="desc"]').val('Oque eu quiser');
}
              
</script>