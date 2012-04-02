<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);


?>

<h1>Registro de Usuário</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>