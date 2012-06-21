<?php
$this->breadcrumbs=array(
	'Tecnico Enfermagem Executa Items'=>array('index'),
	$model->tecnico_enfermagem_cpf,
);

$this->menu=array(
	array('label'=>'List tecnico_enfermagem_executa_item', 'url'=>array('index')),
	array('label'=>'Create tecnico_enfermagem_executa_item', 'url'=>array('create')),
	array('label'=>'Update tecnico_enfermagem_executa_item', 'url'=>array('update', 'id'=>$model->tecnico_enfermagem_cpf)),
	array('label'=>'Delete tecnico_enfermagem_executa_item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tecnico_enfermagem_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage tecnico_enfermagem_executa_item', 'url'=>array('admin')),
);
?>

<h1>View tecnico_enfermagem_executa_item #<?php echo $model->tecnico_enfermagem_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tecnico_enfermagem_cpf',
		'item_id',
		'tecnico_enfermagem_unidade_cnes',
		'quantidade',
		'competencia',
	),
)); ?>
