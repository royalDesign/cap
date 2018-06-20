function valid_fild(valid_type,field){

if(valid_type == 'required'){
  
  if($.trim(field.val()) == ''){
    
    field.focus();    
new PNotify({
    title: 'Campo obrigatório!',
    text: 'Preencha este campo.',
    type: 'error'
    
});
return false;

  }else{
    return true;
  }
  
}else if(valid_type == 'email'){


var emailFilter=/^.+@.+\..{2,}$/;
var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/

var email = field.val();
    
   if(!(emailFilter.test(email))||email.match(illegalChars)){      
field.focus();
new PNotify({
    title: 'E-mail inválido!',
    text: 'Informe um e-mail válido',
    type: 'error'
    
});


      return false;

    }else{
      return true;  
    }
}else if(valid_type == 'select'){

    if($.trim(field.val()) == ''){
    
    field.focus();    
new PNotify({
    title: 'Seleção obrigatória!',
    text: 'Selecione uma opção.',
    type: 'error'
    
});
return false;

  }else{
    return true;
  }

}else if(valid_type == 'password'){
var field2 = $('#password2');

if($.trim(field.val()) != $.trim(field2.val())){
 field.focus();    
new PNotify({
    title: 'Senhas não conferem!',
    text: 'As senhas informadas não coencidem.',
    type: 'error'
    
});
return false;
}else{ return true;}



}else if(valid_type == 'int'){

var number = field.val();

var filter_int = /^.$/;
if(parseInt(number) <= 0 || !filter_int.test(number)){

 field.focus();    
new PNotify({title: 'Número inválido!',text: 'Informe um número inteiro maior que 0',type: 'error'});
return false;
}else{ return true;}



}



}/*END valid_fild*/


function send_form(form,btn,var_control,reset_form,target){

btn.attr('disabled', 'disabled');
form.ajaxSubmit({

url:                  'class/controler.php',
data:                 {exec: var_control},
dataType:             "json",
beforeSubmit:         function(){
  btn.empty().html('<img src="img/load_b.svg" width="20px">Aguarde...');
},
resetForm:        reset_form,
error:              function(resposta){
          new PNotify({
          title: 'Erro!',
          text: 'Desculpa, aconteceu um erro inesperado.',
          type: 'error'
          
          });
},
success:        function(resposta){

new PNotify({
          title: resposta.title,
          text:  resposta.text,
          type:  resposta.type
          
          });  
  

},

complete:     function(){
  
  btn.empty().html('<i class="fa fa-check"></i> Salvar');
  btn.removeAttr('disabled');
  open_target('target='+target);

}

});//fim do ajax subimit

 return false;
}/*END send_form*/




function send_form_main(form,btn,var_control,target){

btn.attr('disabled', 'disabled');
form.ajaxSubmit({

url:                  'sections/'+target+'.php',
data:                 {exec: var_control},
beforeSubmit:         function(){
  btn.empty().html('<img src="img/load_b.svg" width="20px">Aguarde...');
},
resetForm:        false,
error:              function(resposta){
          console.log(resposta);
},
success:        function(resposta){

new PNotify({
          title: 'Sucesso',
          text:  resposta,
          type:  'success'
          
          });  
  

},

complete:     function(){
  
  btn.empty().html('<i class="fa fa-check"></i> Salvar');
  btn.removeAttr('disabled');
  

}

});//fim do ajax subimit

 return false;
}/*END send_form*/




function send_form_file(sender,target,rotina,id=0){
var bar         = $('#'+target+'_b');
var progress    = $('#'+target+'_p');

bar.css("display", "none");


       
      sender.ajaxSubmit({

        url:          'class/controler.php',
        data:           {exec: rotina},
        type:          'post', 
        dataType:      'json',
        beforeSubmit:       function(){
          
        },
        error:          function(){new PNotify({title: 'Error', text: 'Desculpa, erro ao enviar arquivo.',type: 'error'}); },
        resetForm:        true,

        uploadProgress:     function(evento, posicao, total, completo){
            bar.fadeIn('fast');
            var porcentagem = completo + "%";
            progress.width(porcentagem).text(porcentagem);
        },

        success:        function(resposta){
            
            if(resposta.code == -1){
                
                bar.fadeOut('slow', function(){
                progress.width('0%').text('0%');
              });
            new PNotify({title: resposta.title, text: resposta.text,type: resposta.type});
            }else{
              
                bar.fadeOut('slow', function(){
                progress.width('0%').text('0%');

              });

            new PNotify({title: resposta.title, text: resposta.text,type: resposta.type}); 
            }//fim do else
            
            
            
            if(target == 'product'){
                open_target('target='+target+'&id='+id);
                
            }else if(target == 'user'){
                open_target('target='+target+'&id='+id);
            }else{open_target('target='+target);}
            
            
        },
        complete:         function(){    
            
        
        }




      });//fim do ajax subimit



}


function open_target(params,btn){
  
  var conteudo = $('#conteudoGeral');
  if(!btn){
  btn = $('');
   }

  btn.attr('disabled', 'disabled');

  $.ajax({
    url:        'class/controler.php',
    data:       params,
    type:       'post',
    error:      function(){alert('Erro ao acessar a pagina desejada'); },
    beforeSend:   function(){
           
      btn.empty().html('<img src="img/load_b.svg" width="20px">Aguarde...');
    },//fim do beforeSend
    
    success:    function(resposta){
      //conteudo.fadeOut('fast', function(){
      conteudo.empty().append(resposta);  
      //});
      
     
    },//fim do sucesso

    complete:       function(){
      btn.empty().html('<i class="fa fa-check"></i> Salvar');
      btn.removeAttr('disabled');
    } // fim do complete    
  });//fim do ajax
}/*END open_target*/


function sgc_admin(params,target = ''){

  $.ajax({
    url:        'class/controler.php',
    data:       params,
    type:       'post',
    dataType:   'json',

    error:      function(){},
    beforeSend:   function(){
           
      
    },//fim do beforeSend
    
    success:    function(resposta){
      new PNotify({title: resposta.title, text: resposta.text,type: resposta.type});  
     //console.log(resposta);
      
     
    },//fim do sucesso

    complete:       function(){
      
      if(target != ''){
        open_target('target='+target);
      }

    } // fim do complete    
  });//fim do ajax
  
   
}


function select_all_item_list(){

var check_all = $('.check_all');
  check_all.change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
}



 function sgc_clear_search_zipcode() {
                // Limpa valores do formulário de cep.
                $("#address_street").val("");
                $("#address_district").val("");
                $("#address_city").val("");
                $("#address_state").val("");
                
            }

function sgc_get_address(){
  
                //Nova variável "cep" somente com dígitos.
                var cep = $('#address_zipcode').val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#address_street").val("...")
                        $("#address_district").val("...")
                        $("#address_city").val("...")
                        $("#address_state").val("...")
                        

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#address_street").val(dados.logradouro);
                                $("#address_district").val(dados.bairro);
                                $("#address_city").val(dados.localidade);
                                $("#address_state").val(dados.uf);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                sgc_clear_search_zipcode();
new PNotify({
    title: 'CEP inválido!',
    text: 'O cep informado não foi localizado.',
    type: 'info'
    
});
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        sgc_clear_search_zipcode();
new PNotify({
    title: 'CEP inválido!',
    text: 'O cep informado não foi localizado.',
    type: 'info'
    
});

                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    sgc_clear_search_zipcode();
                }
          

}/*END sgc get address*/

function sgc_masc_fild(evt, campo, padrao) {  
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
      
      
function sgc_toggle(element){
    $('#'+element).toggle('fast');
    
}



 function cap_save_days_donate(){
       var params = 'exec=save_days_donate&days='+$('#days_donate').val();
       sgc_admin(params,target = '');        
       
           
        }





