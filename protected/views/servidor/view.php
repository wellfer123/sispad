<?php
$this->breadcrumbs=array(
	'Servidors'=>array('index'),
	$model->cpf,
);

$this->menu=array(
	array('label'=>'List Servidor', 'url'=>array('index')),
	array('label'=>'Create Servidor', 'url'=>array('create')),
	array('label'=>'Update Servidor', 'url'=>array('update', 'id'=>$model->cpf)),
	array('label'=>'Delete Servidor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Servidor', 'url'=>array('admin')),
);
?>

<h1>View Servidor #<?php echo $model->cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cpf',
		'matricula',
		'nome',
		'estado_civil',
		'endereco_id',
		'unidade_cnes',
	),
)); ?>
