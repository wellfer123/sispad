<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidade Gestors'=>array('index'),
	$model->unidade_cnes=>array('view','id'=>$model->unidade_cnes),
	'Update',
);

$this->menu=array(
	array('label'=>'Create UnidadeGestor', 'url'=>array('create')),
	array('label'=>'Manage UnidadeGestor', 'url'=>array('admin')),
);
?>

<h1>Update UnidadeGestor <?php echo $model->unidade_cnes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>