<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	$model->cnes=>array('view','id'=>$model->cnes),
	'Update',
);

$this->menu=array(
	array('label'=>'List Unidade', 'url'=>array('index')),
	array('label'=>'Create Unidade', 'url'=>array('create')),
	array('label'=>'View Unidade', 'url'=>array('view', 'id'=>$model->cnes)),
	array('label'=>'Manage Unidade', 'url'=>array('admin')),
);
?>

<h1>Update Unidade <?php echo $model->cnes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>