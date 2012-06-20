<?php
$this->breadcrumbs=array(
	'Agente Saude Executa Metas'=>array('index'),
	$model->agente_saude_cpf,
);

$this->menu=array(
	array('label'=>'List agente_saude_executa_meta', 'url'=>array('index')),
	array('label'=>'Create agente_saude_executa_meta', 'url'=>array('create')),
	array('label'=>'Update agente_saude_executa_meta', 'url'=>array('update', 'id'=>$model->agente_saude_cpf)),
	array('label'=>'Delete agente_saude_executa_meta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->agente_saude_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage agente_saude_executa_meta', 'url'=>array('admin')),
);
?>

<h1>View agente_saude_executa_meta #<?php echo $model->agente_saude_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'agente_saude_cpf',
		'agente_saude_microarea',
		'unidade_cnes',
		'meta_id',
		'total',
		'data_inicio',
		'data_fim',
	),
)); ?>
