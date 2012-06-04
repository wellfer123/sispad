<?php
$this->breadcrumbs=array(
	'Registro',
);


?>

<h1>Registro de Usuário</h1>

<?php echo $this->renderPartial('_form_frontend', array('model'=>$model)); ?>