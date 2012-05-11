<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
	$model->codigo_area,
);

$this->menu=array(
	array('label'=>'List Equipe', 'url'=>array('index')),
	array('label'=>'Create Equipe', 'url'=>array('create')),
	array('label'=>'Update Equipe', 'url'=>array('update','area'=>$model->codigo_area,'cnes'=>$model->unidade_cnes)),
	array('label'=>'Delete Equipe', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->codigo_area),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Equipe', 'url'=>array('admin')),
);
?>

<h1>View Equipe #<?php echo $model->codigo_area; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codigo_segmento',
		'codigo_area',
		'tipo',
		'unidade_cnes',
		'codigo_microarea',
	),
)); ?>
