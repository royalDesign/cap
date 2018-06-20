Visando obter o resultado final com todas os recursos e funcionalidades foi utilizado neste projeto as tecnologias HTML5 (W3, 2010) para estrutura��o das p�ginas web, CSS3 (W3SCHOOLS, 2017) para estiliza��o e javascript (W3, 2017) juntamente com a biblioteca do JQUERY tornando as p�ginas mais din�micas. Para agilizar o processo de cria��o da interface foi utilizado o template AdminLTE 2.4 que � projetado com todas estas tecnologias.
Painel de administra��o open source e tema de painel de controle. Constru�do sobre o Bootstrap 3, o AdminLTE fornece uma variedade de componentes responsivos, reutiliz�veis e usados com frequ�ncia. (AdminLITE 2.4, 2017). 
HTML5: Hypertext Markup Language 5 (HTML5) � uma linguagem utilizada para desenvolvimento de p�ginas web. Trata-se da vers�o mais recente da linguagem, trazendo diversos novos atributos em rela��o �s vers�es anteriores. Alguns destaques das funcionalidades utilizadas no projeto s�o as tags "date", que abre um calend�rio para que o usu�rio escolha a data de forma interativa, e "time", que permite que o usu�rio insira um hor�rio, dentre v�rias outras.
Javascript: � uma linguagem que, em conjunto com o HTML, permite que fun��es sejam desenvolvidas para que a p�gina web se torne din�mica, permitindo o envio e recebimento de informa��es pelo sistema para que as funcionalidades de fato sejam incorporadas.
CSS3: Cascading Style Sheets 3 (CSS3) permite que sejam adicionados �s p�ginas web todos os estilos necess�rios, como, por exemplo, cores, espa�amentos, tamanhos e tipos de fontes, entre outros. Trata-se da vers�o mais recente da linguagem.

Na programa��o back-end foi utilizado o PHP 7.1 e como a aplica��o se faz necess�rio armazenar os registros dos objetos bem como todo seu tr�mite de entrada e sa�da, utilizarei o banco de dados relacional MYSQL.







3.2 Atores
No processo de an�lise de requisitos foi poss�vel identificar dois atores que ter�o acesso ao sistema.
Administrador: � o usu�rio que ter� total acesso a todas as funcionalidades, somente atrav�s dele ser� poss�vel cadastrar novos usu�rios, excluir registros e editar perfil de outros usu�rios. Mais detalhes ser�o ilustrado no diagrama de caso de uso.
Padr�o: � o usu�rio que geralmente trabalha cotidianamente no sistema, este poder� acessar o sistema para realizar o registro de um novo objeto entregue ao setor, realizar busca caso um poss�vel dono v� em busca de um objeto perdido entre outros.

3.2 Requisitos funcionais
Os requisitos funcionais descrevem as funcionalidades que cada tipo de usu�rio deve ser capaz de acessar no sistema (SOMMERVILLE, 2011). Esses requisitos est�o relacionados �s atividades que o sistema realiza. 
Autentica��o: O sistema deve disponibilizar uma tela de login na qual o usu�rio previamente cadastrado possa ter acesso ao sistema.
Recuperar senha: O sistema deve disponibilizar uma forma do usu�rio em caso de esquecimento recuperar a senha.
Estat�sticas acerca dos objetos: O sistema deve disponibilizar em sua tela inicial algumas estat�sticas acerca dos objetos registrados no banco de dados para que seja poss�vel visualizar de forma simples e pr�tica a movimenta��o do setor de forma geral.
Listagem de categoria de objetos: O sistema deve disponibilizar uma tela para que seja listado todas as categorias ativas e inativas dos objetos.
Cadastro de categoria de objetos: O sistema deve disponibilizar uma tela para que seja poss�vel realizar o cadastro de categorias para os objetos.
Edi��o de categoria de objetos: O sistema deve disponibilizar uma tela para que seja poss�vel realizar a edi��o das categorias dos objetos.
Listagem dos objetos: O sistema deve disponibilizar uma tela para listagem de todos os objetos que deram entrada no setor de achados e perdidos, estes objetos ter�o os seguintes status.
1.	Em posse: objeto registrado, guardado e dispon�vel para devolu��o.
2.	Entregue: objetos que o dono foi buscar e comprovou informando caracter�sticas especificas que realmente se tratava do dono do objeto ao mudar para este status o sistema deve disponibilizar campo para que seja salvo o nome do propriet�rio, documento de identifica��o do mesmo e data de entrega.
3.	Dispon�vel para doa��o: s�o objetos que passaram mais de 30 dias em posse e nenhum propriet�rio apareceu para reclama-lo, o sistema identifica automaticamente estes objetos e muda para o status Disp. p/ doa��o.
4.	Doados: objetos que estavam dispon�veis para doa��o e foram doados, para salvar este status o sistema solicita o nome ou raz�o social do benefici�rio da doa��o, bem como um documento de identifica��o que pode ser RG ou CNPJ em caso de pessoa jur�dica e a data de doa��o.
Cadastro dos objetos: O sistema deve disponibilizar uma tela para que seja poss�vel realizar o cadastro dos objetos entregues ao setor de achados e perdidos.
Edi��o dos objetos: O sistema deve disponibilizar uma tela para que seja poss�vel realizar a edi��o dos objetos cadastrados.
Listagem de usu�rios: O sistema deve disponibilizar uma tela para que o usu�rio administrador possa visualizar todos os usu�rios do sistema.
Cadastro de usu�rios: O sistema deve disponibilizar uma tela para que seja poss�vel cadastrar novos usu�rios.
Edi��o de usu�rios: O sistema deve disponibilizar uma tela pra o administrador realizar edi��o nos registros de usu�rios
Edi��o do usu�rio logado: o sistema deve disponibilizar uma tela para o usu�rio logado editar suas informa��es, e alterar sua senha caso queira.
Bloqueio e desbloqueio do usu�rio: O sistema deve disponibilizar uma forma de bloquear ou desbloquear o acesso do usu�rio caso necess�rio.
