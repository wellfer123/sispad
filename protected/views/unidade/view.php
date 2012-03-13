<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	$model->cnes,
);

$this->menu=array(
    
    
	array('label'=>'List Unidade', 'url'=>array('index')),
	array('label'=>'Create Unidade', 'url'=>array('create')),
	array('label'=>'Update Unidade', 'url'=>array('update', 'id'=>$model->cnes)),
	array('label'=>'Delete Unidade', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cnes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Unidade', 'url'=>array('admin')),
);
?>

<h1>View Unidade #<?php echo $model->cnes; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cnes',
		'descricao',
		'nome',
		'cidade.cidade_nome',
	),
)); ?>
