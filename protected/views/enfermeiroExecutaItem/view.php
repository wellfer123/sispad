<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Items'=>array('index'),
	$model->enfermeiro_cpf,
);

$this->menu=array(
	array('label'=>'List enfermeiro_executa_item', 'url'=>array('index')),
	array('label'=>'Create enfermeiro_executa_item', 'url'=>array('create')),
	array('label'=>'Update enfermeiro_executa_item', 'url'=>array('update', 'id'=>$model->enfermeiro_cpf)),
	array('label'=>'Delete enfermeiro_executa_item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->enfermeiro_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage enfermeiro_executa_item', 'url'=>array('admin')),
);
?>

<h1>View enfermeiro_executa_item #<?php echo $model->enfermeiro_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'enfermeiro_cpf',
		'item_id',
		'enfermeiro_unidade_cnes',
		'quantidade',
		'competencia',
	),
)); ?>
