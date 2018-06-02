 
<?php 
$km_qik_user_permissions = array('candidates');

if(!in_array('candidates_',$km_qik_user_permissions)){

$access_locked = '<section class="content container-fluid">';
$access_locked .= '<div class="col-sm-offset-3 col-sm-6">';     
$access_locked .= '    <div class="box box-danger">';
$access_locked .= '      <div class="box-body">';
$access_locked .= '        <h3 class="text-center text-danger">Acesso negado!</h3>';   
$access_locked .= '        <p class="text-center">Você tentou acessar este módulo de maneira indevida e está sendo monitorado.</p>';
$access_locked .= '        <hr class="text-danger">';
$access_locked .= '        <p><strong>Usuário:</strong> Rogério Nascimento</p>';
$access_locked .= '        <p><strong>Data:</strong> 10/02/2018 09:25:52</p>';
$access_locked .= '        <p><strong>Módulo:</strong> Gestão da expansão</p>';
$access_locked .= '      </div>';
$access_locked .= '    </div>';
$access_locked .= '  </div>';
$access_locked .= '</section>';

exit($access_locked);

}
 ?>