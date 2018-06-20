Visando obter o resultado final com todas os recursos e funcionalidades foi utilizado neste projeto as tecnologias HTML5 (W3, 2010) para estruturação das páginas web, CSS3 (W3SCHOOLS, 2017) para estilização e javascript (W3, 2017) juntamente com a biblioteca do JQUERY tornando as páginas mais dinâmicas. Para agilizar o processo de criação da interface foi utilizado o template AdminLTE 2.4 que é projetado com todas estas tecnologias.
Painel de administração open source e tema de painel de controle. Construído sobre o Bootstrap 3, o AdminLTE fornece uma variedade de componentes responsivos, reutilizáveis e usados com frequência. (AdminLITE 2.4, 2017). 
HTML5: Hypertext Markup Language 5 (HTML5) é uma linguagem utilizada para desenvolvimento de páginas web. Trata-se da versão mais recente da linguagem, trazendo diversos novos atributos em relação às versões anteriores. Alguns destaques das funcionalidades utilizadas no projeto são as tags "date", que abre um calendário para que o usuário escolha a data de forma interativa, e "time", que permite que o usuário insira um horário, dentre várias outras.
Javascript: É uma linguagem que, em conjunto com o HTML, permite que funções sejam desenvolvidas para que a página web se torne dinâmica, permitindo o envio e recebimento de informações pelo sistema para que as funcionalidades de fato sejam incorporadas.
CSS3: Cascading Style Sheets 3 (CSS3) permite que sejam adicionados às páginas web todos os estilos necessários, como, por exemplo, cores, espaçamentos, tamanhos e tipos de fontes, entre outros. Trata-se da versão mais recente da linguagem.

Na programação back-end foi utilizado o PHP 7.1 e como a aplicação se faz necessário armazenar os registros dos objetos bem como todo seu trâmite de entrada e saída, utilizarei o banco de dados relacional MYSQL.







3.2 Atores
No processo de análise de requisitos foi possível identificar dois atores que terão acesso ao sistema.
Administrador: é o usuário que terá total acesso a todas as funcionalidades, somente através dele será possível cadastrar novos usuários, excluir registros e editar perfil de outros usuários. Mais detalhes serão ilustrado no diagrama de caso de uso.
Padrão: é o usuário que geralmente trabalha cotidianamente no sistema, este poderá acessar o sistema para realizar o registro de um novo objeto entregue ao setor, realizar busca caso um possível dono vá em busca de um objeto perdido entre outros.

3.2 Requisitos funcionais
Os requisitos funcionais descrevem as funcionalidades que cada tipo de usuário deve ser capaz de acessar no sistema (SOMMERVILLE, 2011). Esses requisitos estão relacionados às atividades que o sistema realiza. 
Autenticação: O sistema deve disponibilizar uma tela de login na qual o usuário previamente cadastrado possa ter acesso ao sistema.
Recuperar senha: O sistema deve disponibilizar uma forma do usuário em caso de esquecimento recuperar a senha.
Estatísticas acerca dos objetos: O sistema deve disponibilizar em sua tela inicial algumas estatísticas acerca dos objetos registrados no banco de dados para que seja possível visualizar de forma simples e prática a movimentação do setor de forma geral.
Listagem de categoria de objetos: O sistema deve disponibilizar uma tela para que seja listado todas as categorias ativas e inativas dos objetos.
Cadastro de categoria de objetos: O sistema deve disponibilizar uma tela para que seja possível realizar o cadastro de categorias para os objetos.
Edição de categoria de objetos: O sistema deve disponibilizar uma tela para que seja possível realizar a edição das categorias dos objetos.
Listagem dos objetos: O sistema deve disponibilizar uma tela para listagem de todos os objetos que deram entrada no setor de achados e perdidos, estes objetos terão os seguintes status.
1.	Em posse: objeto registrado, guardado e disponível para devolução.
2.	Entregue: objetos que o dono foi buscar e comprovou informando características especificas que realmente se tratava do dono do objeto ao mudar para este status o sistema deve disponibilizar campo para que seja salvo o nome do proprietário, documento de identificação do mesmo e data de entrega.
3.	Disponível para doação: são objetos que passaram mais de 30 dias em posse e nenhum proprietário apareceu para reclama-lo, o sistema identifica automaticamente estes objetos e muda para o status Disp. p/ doação.
4.	Doados: objetos que estavam disponíveis para doação e foram doados, para salvar este status o sistema solicita o nome ou razão social do beneficiário da doação, bem como um documento de identificação que pode ser RG ou CNPJ em caso de pessoa jurídica e a data de doação.
Cadastro dos objetos: O sistema deve disponibilizar uma tela para que seja possível realizar o cadastro dos objetos entregues ao setor de achados e perdidos.
Edição dos objetos: O sistema deve disponibilizar uma tela para que seja possível realizar a edição dos objetos cadastrados.
Listagem de usuários: O sistema deve disponibilizar uma tela para que o usuário administrador possa visualizar todos os usuários do sistema.
Cadastro de usuários: O sistema deve disponibilizar uma tela para que seja possível cadastrar novos usuários.
Edição de usuários: O sistema deve disponibilizar uma tela pra o administrador realizar edição nos registros de usuários
Edição do usuário logado: o sistema deve disponibilizar uma tela para o usuário logado editar suas informações, e alterar sua senha caso queira.
Bloqueio e desbloqueio do usuário: O sistema deve disponibilizar uma forma de bloquear ou desbloquear o acesso do usuário caso necessário.
