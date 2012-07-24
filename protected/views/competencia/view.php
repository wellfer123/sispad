<?php
$this->breadcrumbs=array(
	'Competencias'=>array('index'),
	$model->mes_ano,
);

$this->menu=array(
	array('label'=>'List Competencia', 'url'=>array('index')),
	array('label'=>'Create Competencia', 'url'=>array('create')),
	array('label'=>'Update Competencia', 'url'=>array('update', 'id'=>$model->mes_ano)),
	array('label'=>'Delete Competencia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mes_ano),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Competencia', 'url'=>array('admin')),
);
?>

<h1>View Competencia #<?php echo $model->mes_ano; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mes_ano',
		'ativo',
	),
)); ?>
