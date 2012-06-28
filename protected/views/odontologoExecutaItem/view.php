<?php
$this->breadcrumbs=array(
	'Odontologo Executa Items'=>array('index'),
	$model->odontologo_cpf,
);

$this->menu=array(
	array('label'=>'List odontologo_executa_item', 'url'=>array('index')),
	array('label'=>'Create odontologo_executa_item', 'url'=>array('create')),
	array('label'=>'Update odontologo_executa_item', 'url'=>array('update', 'id'=>$model->odontologo_cpf)),
	array('label'=>'Delete odontologo_executa_item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->odontologo_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage odontologo_executa_item', 'url'=>array('admin')),
);
?>

<h1>View odontologo_executa_item #<?php echo $model->odontologo_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'odontologo_cpf',
		'item_id',
		'odontologo_unidade_cnes',
		'quantidade',
		'competencia',
	),
)); ?>
