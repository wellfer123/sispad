<?php
$this->breadcrumbs=array(
	'Procedimentos'=>array('index'),
	$model->codigo=>array('view','id'=>$model->codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Procedimento', 'url'=>array('index')),
	array('label'=>'Create Procedimento', 'url'=>array('create')),
	array('label'=>'View Procedimento', 'url'=>array('view', 'id'=>$model->codigo)),
	array('label'=>'Manage Procedimento', 'url'=>array('admin')),
);
?>

<h1>Update Procedimento <?php echo $model->codigo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>