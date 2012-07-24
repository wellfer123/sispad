<?php
$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Cargos', 'url'=>array('index')),
	array('label'=>'Criar Cargo', 'url'=>array('create')),
	array('label'=>'Atualizar Cargo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Deletar Cargo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Cargo', 'url'=>array('admin')),
);
?>

<h1>Cargo: <?php echo $model->nome; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
	),
)); ?>
