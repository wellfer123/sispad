<?php
$this->breadcrumbs=array(
	'Setors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Setor', 'url'=>array('index')),
	array('label'=>'Create Setor', 'url'=>array('create')),
	array('label'=>'Update Setor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Setor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Setor', 'url'=>array('admin')),
);
?>

<h1>View Setor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'descricao',
		'departamento_id',
	),
)); ?>
