<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Unidade', 'url'=>array('index')),
	array('label'=>'Manage Unidade', 'url'=>array('admin')),
);
?>

<h1>Create Unidade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>