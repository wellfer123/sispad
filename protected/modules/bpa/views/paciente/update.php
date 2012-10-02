<?php
$this->breadcrumbs=array(
	'Pacientes'=>array('index'),
	$model->cns=>array('view','id'=>$model->cns),
	'Update',
);

$this->menu=array(
	array('label'=>'List Paciente', 'url'=>array('index')),
	array('label'=>'Create Paciente', 'url'=>array('create')),
	array('label'=>'View Paciente', 'url'=>array('view', 'id'=>$model->cns)),
	array('label'=>'Manage Paciente', 'url'=>array('admin')),
);
?>

<h1>Update Paciente <?php echo $model->cns; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>