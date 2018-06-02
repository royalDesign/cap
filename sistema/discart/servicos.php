<?php
require_once "../../class/Conexao.php";

$mes = date("m");      // Mês desejado, pode ser por ser obtido por POST, GET, etc.
$ano = date("Y"); // Ano atual
$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!

$date_start = date('Y-01-01');
$date_end   = date('Y-m-').$ultimo_dia;

$periodo ="'".$date_start."','".$date_end."'";

?>
<section class="content-header">
      <h1>
        Ordens de serviços
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?Menu=Home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Serviços realizados</li>
      </ol>
    </section>
    <!-- Main content -->   
    <section class="content container-fluid">
<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-3" style="margin-left: -15px;">
              <!-- Date range -->
              <div class="form-group">
                <label>Período:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->              
              </div>

    <div class="col-sm-2">
      <label>Lançar</label>
      <button class="btn btn-default form-control">Novo</button>
    </div>
            </div>
            <!-- /.box-header -->
            <div id="listaVendas">
            
              
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



<div class="modal fade" id="modal-venda">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span id="loadEdit" style="display: none;"><img src="../img/load_b.svg" width="25px"></span>Ordem de serviço</h4>
              </div>

              <div class="modal-body">
              <div class="debugEdit" style="display: none;"></div>                
              <div class="box-modal" id="modal_venda_popula">

                
              <div class="row">
                <div class="col-sm-6">
                  <h2 class="page-header">Produtos</h2>
                  <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Produto</th>
                  <th>Qtd</th>
                  <th>Sub Total</th>
                  <th>Desconto</th>              
                  
                </tr>
                </thead>
                <tbody>


                </tbody>
                  <tr>
                    <td>256</td>
                    <td>escova progressiva</td>
                    <td>1</td>
                    <td>R$ 120,00</td>
                    <td>R$ 20,00</td>
                  </tr>                  

                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Produto</th>
                  <th>Qtd</th>
                  <th>Sub Total</th>
                  <th>Desconto</th> 
                </tr>
                </tfoot>
              </table>
                </div><!--col-sm-06-->

                <div class="col-sm-6">
                  <div class="row">
                    <h2 class="page-header">Informações da venda</h2>

<div class="col-md-7">
<p class="pgsub" style="text-align: center;height: 34px;">Sub Total R$ <span class="totalSub" id="22.6">22.6</span></p>
</div>

<div class="col-md-5">
<p class="pgdesc" style="text-align: center;height: 34px;">Descontos R$ <span class="totalDesc" id="2.6">2.6</span></p>
</div>

</div>

<div class="row">
<div class="col-sm-12">
<p id="total" style="height: 34px;" class="text-center pgVenda">TOTAL R$ <span class="total" id="20">20</span></p>
</div>
</div>

<div class="row" style="margin-bottom: 10px;">

<div class="col-sm-6">
<label for="valorPendente">Valor pendente</label>
<div class="input-group">
                <span class="input-group-addon">R$</span>
                <!--<input name="valorPendente" id="valorPendente" class="form-control" type="text">-->

              </div>
</div>


<div class="col-sm-6">
<label for="valorPago">Valor pago</label>
<div class="input-group">
                <span class="input-group-addon">R$</span>
                <input name="valorPago" id="valorPago" class="form-control" type="text">

              </div>
</div>

</div>

<div class="row">
<div class="col-sm-4">
<button class="btn btn-danger form-control cancelar" id="265"><i class="fa fa-times" aria-hidden="true"></i>
        Cançelar</button>
</div>
<div class="col-sm-8">
<button class="btn btn-info form-control salvarVenda" id="265" style=""><i class="fa fa-check"></i>
        Salvar</button>
</div>
</div>



    </div>

               
              </div><!--ROW-->
             
                
        

           
          
              </div>

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
       
function reset(){
      $("#toggleCSS").attr("href", "css/alertify/alertify.default.css");
      alertify.set({
        labels : {
          ok     : "SIM",
          cancel : "NÂO"
        },
        delay : 5000,
        buttonReverse : true,
        buttonFocus   : "SIM"
      });
    }
reset();
function sig_exe(data){
var ret;
  $.ajax({
      url:              'sections/controller.php',
      type:             'post',
      data:             data,
      beforeSend:       function(){
        
      },
      error:            function(){
        alertify.error('Não foi possível realizar esta operação');
      },
      success:          function(retorno){

       ret = retorno;
      }

    });


return ret;
}

$(function(){

listaVendas(<?php echo $periodo;?>);

$('#reservation').daterangepicker(
{

  locale: {
      format: 'DD/MM/YYYY'
  },

    "startDate": <?php echo '"'.date('d/m/Y', strtotime($date_start)).'"';?>,
    "endDate": <?php echo '"'.date('d/m/Y', strtotime($date_end)).'"';?>,
    "opens": "right",
}, function(start, end, label) {
  //console.log("New date range selected: " + start.format('YYYY-MM-DD') + " to " + end.format('YYYY-MM-DD') + " (predefined range: " + label + ")");
listaVendas(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
}

          );

      });
    </script>
    <script>
  $(function () {  
    $('#datepicker').datepicker({
autoclose: true,
format: 'd/m/yyyy',
language: 'pt-br'
});

  });


  function listaVendas(date_start,date_end){
  $.ajax({
    url:                'sections/controller.php',
    type:               'POST',
    data:              'listarVenda=listarVendas&date_start='+date_start+'&date_end='+date_end,
    beforeSend: function(){
$('#listaVendas').empty().append('<td colspan="7" class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</td>');

    },
    success:              function(resposta){
      $('#listaVendas').empty().append(resposta).fadeIn('slow');
      
    }

  });//fim do ajax
}//fim da func



/*===============================|EDITANDO categorias E ATUALIZANDO A LISTA|==================================*/

$('#listaVendas').on('click', '.os_view',function(){
        var editid       = $(this).attr("id");
        var editdata     = "editar=editar&ebusca="+editid;//variaveis que serao passadas para o arquivo php
        var liaction     = $('tr[id="'+editid+'"]');
        var modal     = $('#modal_venda_popula');        
        liaction.css({
                'background-color': 'rgb(90, 167, 251)',
                 border: '1px solid green'
                });

      //alert('id = '+editid);

    $.ajax({
    url:                'sections/controller.php',
    type:               'POST',
    data:              'popula_modal=venda&vendaId='+editid,
    beforeSend: function(){
modal.empty().append('<div class="bg-info" style="font-size: 20px; color: #000;"><img src="../img/load_b.svg" width="40px">Carregando...</div>');

    },
    success:              function(resposta){
      modal.empty().append(resposta).fadeIn('slow');
      
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

/*==============================|salvando alteracoes na venda|==========================*/
function sig_save_pending(id,v_pendente,v_pago){

  var data = 'exe=fw_save_pending&id_venda='+id+'&v_pendente='+v_pendente+'&v_pago='+v_pago;

  alertify.confirm('Deseja dar entrada neste valor para esta venda?', function (e){
  if(e){

  var resp = sig_exe(data);
  alert(resp);
  if(resp == 1){
    alertify.success('Venda quitada com sucesso!');
    listaVendas(<?php echo $periodo;?>);
    $('#modal-venda').fadeOut();
  }else if(resp == -1){
    alertify.error('Erro ao quitar venda!');
  }

  }else{
    alertify.error('Ação Cançelada');

  }
  });
}

</script>