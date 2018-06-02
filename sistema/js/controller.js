$(function(){
	
	function openCategoria(){

  //alert('Olá mundo clicando no menu');
  var conteudo = $('#conteudoGeral');
  //conteudo.empty();

  $.ajax({
    url:      'sections/controller.php',
    data:         'menu=categoria',
    type:       'post',
    error:      function(){alert('Erro ao acessar a pagina desejada'); },
    beforeSend:   function(){
      //conteudo.fadeOut('fast');
      //loader.fadeIn('slow');
    },//fim do beforeSend
    
    success:    function(resposta){
      conteudo.empty().append(resposta).fadeIn('slow');
    },//fim do sucesso

    complete:       function(){
      //loader.fadeOut('slow');
    } // fim do complete    
  });//fim do ajax
}


});//fim do DOM 