<?php
$this->breadcrumbs=array(
	'Medico Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List medico_executa_item', 'url'=>array('index')),
	array('label'=>'Manage medico_executa_item', 'url'=>array('admin')),
);
?>

<h1>Create medico_executa_item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>