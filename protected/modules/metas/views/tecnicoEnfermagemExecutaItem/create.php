<?php
$this->breadcrumbs=array(
	'Tecnico Enfermagem Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List tecnico_enfermagem_executa_item', 'url'=>array('index')),
	array('label'=>'Manage tecnico_enfermagem_executa_item', 'url'=>array('admin')),
);
?>

<h1>Create tecnico_enfermagem_executa_item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>