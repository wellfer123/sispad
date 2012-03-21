<?php
$this->breadcrumbs=array(
	'Setores'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Cadastro de Setor', 'url'=>array('create')),
	array('label'=>'Atualização de Setor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage de Setor', 'url'=>array('admin')),
);
?>

<h1>Setor <?php echo $model->nome; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'descricao',
		'departamento_id',
	),
)); ?>
