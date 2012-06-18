<?php
$this->breadcrumbs=array(
	'Odontologo Executa Metas'=>array('index'),
	$model->odontologo_cpf,
);

$this->menu=array(
	array('label'=>'List odontologo_executa_meta', 'url'=>array('index')),
	array('label'=>'Create odontologo_executa_meta', 'url'=>array('create')),
	array('label'=>'Update odontologo_executa_meta', 'url'=>array('update', 'id'=>$model->odontologo_cpf)),
	array('label'=>'Delete odontologo_executa_meta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->odontologo_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage odontologo_executa_meta', 'url'=>array('admin')),
);
?>

<h1>View odontologo_executa_meta #<?php echo $model->odontologo_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'odontologo_cpf',
		'unidade_cnes',
		'meta_id',
		'total',
		'data_inicio',
		'data_fim',
	),
)); ?>
