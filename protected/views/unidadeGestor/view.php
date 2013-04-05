<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidade Gestors'=>array('index'),
	$model->unidade_cnes,
);

$this->menu=array(
	array('label'=>'List UnidadeGestor', 'url'=>array('index')),
	array('label'=>'Create UnidadeGestor', 'url'=>array('create')),
	array('label'=>'Update UnidadeGestor', 'url'=>array('update', 'id'=>$model->unidade_cnes)),
	array('label'=>'Delete UnidadeGestor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->unidade_cnes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UnidadeGestor', 'url'=>array('admin')),
);
?>

<h1>View UnidadeGestor #<?php echo $model->unidade_cnes; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'unidade_cnes',
		'servidor_cpf',
	),
)); ?>
