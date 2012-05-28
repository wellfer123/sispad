<?php
$this->breadcrumbs=array(
	'Usuario Desktops'=>array('index'),
	$model->servidor_cpf,
);

$this->menu=array(
	array('label'=>'List usuario_desktop', 'url'=>array('index')),
	array('label'=>'Create usuario_desktop', 'url'=>array('create')),
	array('label'=>'Update usuario_desktop', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
	array('label'=>'Delete usuario_desktop', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->servidor_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage usuario_desktop', 'url'=>array('admin')),
);
?>

<h1>View usuario_desktop #<?php echo $model->servidor_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'token',
		'serial_aplicacao',
	),
)); ?>
