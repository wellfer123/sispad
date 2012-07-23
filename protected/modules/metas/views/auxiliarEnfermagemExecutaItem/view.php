<?php
$this->breadcrumbs=array(
	'Auxiliar Enfermagem Executa Items'=>array('index'),
	$model->auxiliar_enfermagem_cpf,
);

$this->menu=array(
	array('label'=>'List auxiliar_enfermagem_executa_item', 'url'=>array('index')),
	array('label'=>'Create auxiliar_enfermagem_executa_item', 'url'=>array('create')),
	array('label'=>'Update auxiliar_enfermagem_executa_item', 'url'=>array('update', 'id'=>$model->auxiliar_enfermagem_cpf)),
	array('label'=>'Delete auxiliar_enfermagem_executa_item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->auxiliar_enfermagem_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage auxiliar_enfermagem_executa_item', 'url'=>array('admin')),
);
?>

<h1>View auxiliar_enfermagem_executa_item #<?php echo $model->auxiliar_enfermagem_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'auxiliar_enfermagem_cpf',
		'item_id',
		'auxiliar_enfermagem_unidade_cnes',
		'quantidade',
		'competencia',
	),
)); ?>
