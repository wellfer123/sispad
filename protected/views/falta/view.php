<?php
$this->breadcrumbs=array(
	'Faltas'=>array('index'),
	$model->dia,
);

$this->menu=array(
	array('label'=>'List falta', 'url'=>array('index')),
	array('label'=>'Create falta', 'url'=>array('create')),
	array('label'=>'Update falta', 'url'=>array('update', 'id'=>$model->dia)),
	array('label'=>'Delete falta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dia),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage falta', 'url'=>array('admin')),
);
?>

<h1>View falta #<?php echo $model->dia; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dia',
		'mes',
		'servidor_cpf',
		'data_envio',
		'motivo',
		'motivo_id',
		'ano',
	),
)); ?>
