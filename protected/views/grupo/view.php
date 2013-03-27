<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
	'Grupos'=>array('index'),
	$model->codigo,
);

$this->menu=array(
	array('label'=>'List Grupo', 'url'=>array('index')),
	array('label'=>'Create Grupo', 'url'=>array('create')),
	array('label'=>'Update Grupo', 'url'=>array('update', 'id'=>$model->codigo)),
	array('label'=>'Delete Grupo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Grupo', 'url'=>array('admin')),
);
?>

<h1>View Grupo #<?php echo $model->codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codigo',
		'nome',
	),
)); ?>
