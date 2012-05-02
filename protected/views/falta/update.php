<?php
$this->breadcrumbs=array(
	'Faltas'=>array('index'),
	$model->dia=>array('view','id'=>$model->dia),
	'Update',
);

$this->menu=array(
	array('label'=>'List falta', 'url'=>array('index')),
	array('label'=>'Create falta', 'url'=>array('create')),
	array('label'=>'View falta', 'url'=>array('view', 'id'=>$model->dia)),
	array('label'=>'Manage falta', 'url'=>array('admin')),
);
?>

<h1>Update falta <?php echo $model->dia; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>