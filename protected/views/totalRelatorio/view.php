<?php
$this->breadcrumbs=array(
	'Total Relatorios'=>array('index'),
	$model->ano,
);

$this->menu=array(
	array('label'=>'List TotalRelatorio', 'url'=>array('index')),
	array('label'=>'Create TotalRelatorio', 'url'=>array('create')),
	array('label'=>'Update TotalRelatorio', 'url'=>array('update', 'id'=>$model->ano)),
	array('label'=>'Delete TotalRelatorio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ano),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TotalRelatorio', 'url'=>array('admin')),
);
?>

<h1>View TotalRelatorio #<?php echo $model->ano; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ano',
		'mes',
		'quantidade',
		'data_envio',
		'servidor_cpf',
	),
)); ?>
