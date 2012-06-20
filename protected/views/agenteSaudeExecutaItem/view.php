<?php
$this->breadcrumbs=array(
	'Agente Saude Executa Items'=>array('index'),
	$model->agente_saude_cpf,
);

$this->menu=array(
	array('label'=>'List agente_saude_executa_item', 'url'=>array('index')),
	array('label'=>'Create agente_saude_executa_item', 'url'=>array('create')),
	array('label'=>'Update agente_saude_executa_item', 'url'=>array('update', 'id'=>$model->agente_saude_cpf)),
	array('label'=>'Delete agente_saude_executa_item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->agente_saude_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage agente_saude_executa_item', 'url'=>array('admin')),
);
?>

<h1>View agente_saude_executa_item #<?php echo $model->agente_saude_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'agente_saude_cpf',
		'item_id',
		'agente_saude_unidade_cnes',
		'quantidade',
		'competencia',
	),
)); ?>
