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
}


}/*END valid_fild*/


function send_form(form,btn,var_control){

btn.attr('disabled', 'disabled');
form.ajaxSubmit({

url:                  'class/controler.php',
data:                 {exec: var_control},
beforeSubmit:         function(){
  btn.empty().html('<img src="img/load_b.svg" width="20px">Aguarde...');
},
resetForm:        true,
error:              function(resposta){
  console.log('Desculpa, aconteceu um erro inesperado.'+resposta);
   new PNotify({title: 'Erro!',text: 'Desculpa, aconteceu um erro inesperado.'+resposta,type: 'error'});


},
success:        function(resposta){
  
if(resposta == -1){

new PNotify({
          title: 'Login inválido!',
          text: 'E-mail ou senha incorreto',
          type: 'info'
          
          });

}else if(resposta == -2){
    
    new PNotify({title: 'Acesso negado!',text: 'Usuário bloqueado, em caso de dúvida contate o administrador do sistema.',type: 'info'});
    
}else{
   
   new PNotify({title: 'Sucesso!',text: 'Efetuando login!',type: 'success'});
  window.location='sistema/'; 
}  
  

},

complete:     function(){
  
  btn.empty().html('<i class="fa fa-sign-in" aria-hidden="true"></i> Entrar');
  btn.removeAttr('disabled');

}

});//fim do ajax subimit

 return false;
}/*END send_form*/


function send_mail_recovery(){
    
    var email   = $('#email_recovery');
    var btn     = $('.j_send_recover');
    if(valid_fild('email',email)){
                
    var params = 'exec=recovery_send_email&email='+email.val();
    
    $.ajax({
    url:        'class/controler.php',
    data:       params,
    type:       'post',
    dataType:   'json',
    error:      function(){alert('Erro ao acessar a pagina desejada'); },
    beforeSend:   function(){
           
      btn.empty().html('<img src="img/load_b.svg" width="20px">Aguarde...');
    },//fim do beforeSend
    
    success:    function(resposta){
        console.log(resposta);
   if(resposta.error_number == 0){       
       new PNotify({title: 'Sucesso!',text: resposta.message,type: 'success'});
        $('.content-recover').slideUp('slow', function (){         
        $('.login-form').slideDown('slow');
    });
    
   }else if(resposta.error_number == 1){       
       new PNotify({title: 'Ops!',text: resposta.message,type: 'info'});
   }else{
       new PNotify({title: 'Sucesso!',text: resposta.message,type: 'error'});
   }
      
     
    },//fim do sucesso

    complete:       function(){
      btn.empty().html('Enviar');
      btn.removeAttr('disabled');
    } // fim do complete    
  });//fim do ajax
        
        
    }//fim da validação do e-mail
}
function logar(){

  var form    = $('form[name="login"]');
  var email   = $('#email');
  var senha   = $('#senha');
  var debug   = $('.debug');
  var btn     = $('#j_send');
  

if(valid_fild('email',email) && valid_fild('required',senha)){


//alert('passei na validação');
send_form(form,btn,'logar');


form.submit(function(event) {
  return false
});

}else{

form.submit(function(event) {
  return false
});
}
}/*End logar*/
