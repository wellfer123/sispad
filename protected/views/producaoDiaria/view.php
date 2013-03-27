<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */

$this->breadcrumbs=array(
	'Producao Diarias'=>array('index'),
	$model->unidade_cnes,
);

$this->menu=array(
	array('label'=>'List ProducaoDiaria', 'url'=>array('index')),
	array('label'=>'Create ProducaoDiaria', 'url'=>array('create')),
	array('label'=>'Update ProducaoDiaria', 'url'=>array('update', 'id'=>$model->unidade_cnes)),
	array('label'=>'Delete ProducaoDiaria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->unidade_cnes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProducaoDiaria', 'url'=>array('admin')),
);
?>

<h1>View ProducaoDiaria #<?php echo $model->unidade_cnes; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'unidade_cnes',
		'servidor_cpf',
		'profissao_codigo',
		'quantidade',
		'data',
	),
)); ?>
