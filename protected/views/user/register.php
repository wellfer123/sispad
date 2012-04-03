<?php
$this->breadcrumbs=array(
	'Usuários'=>array('index'),
	'Registro',
);


?>

<h1>Registro de Usuário</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>