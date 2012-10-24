<?php
$this->breadcrumbs=array(
	'Pacientes'=>array('index'),
	$model->cns,
);

$this->menu=array(
	array('label'=>'List Paciente', 'url'=>array('index')),
	array('label'=>'Create Paciente', 'url'=>array('create')),
	array('label'=>'Update Paciente', 'url'=>array('update', 'id'=>$model->cns)),
	array('label'=>'Delete Paciente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cns),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Paciente', 'url'=>array('admin')),
);
?>

<h1>View Paciente #<?php echo $model->cns; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cns',
		'nome',
		'sexo',
		'data_nascimento',
		'cidade',
		'nacionalidade',
		'raca',
		'etnia',
		'ultima_atualizacao',
		'data_cadastro',
	),
)); ?>
