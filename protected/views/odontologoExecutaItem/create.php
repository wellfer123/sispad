<?php
$this->breadcrumbs=array(
	'Odontologo Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List odontologo_executa_item', 'url'=>array('index')),
	array('label'=>'Manage odontologo_executa_item', 'url'=>array('admin')),
);
?>

<h1>Create odontologo_executa_item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>