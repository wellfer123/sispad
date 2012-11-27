<?php
$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	'Visualização',
);

$this->menu=array(
	array('label'=>'Listar Cargos', 'url'=>array('index')),
	array('label'=>'Cadastrar Cargo', 'url'=>array('create')),
	array('label'=>'Atualizar Cargo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Administrar Cargo', 'url'=>array('admin')),
);
?>

<div class="update">

<h1>Cargo: <?php echo $model->nome; ?></h1>

</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
	),
)); ?>
