<?php
$this->breadcrumbs=array(
	'Tecnico Enfermagem Executa Metas'=>array('index'),
	$model->tecnico_enfermagem_cpf,
);

$this->menu=array(
	array('label'=>'List tecnico_enfermagem_executa_meta', 'url'=>array('index')),
	array('label'=>'Create tecnico_enfermagem_executa_meta', 'url'=>array('create')),
	array('label'=>'Update tecnico_enfermagem_executa_meta', 'url'=>array('update', 'id'=>$model->tecnico_enfermagem_cpf)),
	array('label'=>'Delete tecnico_enfermagem_executa_meta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tecnico_enfermagem_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage tecnico_enfermagem_executa_meta', 'url'=>array('admin')),
);
?>

<h1>View tecnico_enfermagem_executa_meta #<?php echo $model->tecnico_enfermagem_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tecnico_enfermagem_cpf',
		'unidade_cnes',
		'meta_id',
		'total',
		'data_inicio',
		'data_fim',
	),
)); ?>
