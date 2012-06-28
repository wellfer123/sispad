<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List enfermeiro_executa_item', 'url'=>array('index')),
	array('label'=>'Manage enfermeiro_executa_item', 'url'=>array('admin')),
);
?>

<h1>Create enfermeiro_executa_item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>