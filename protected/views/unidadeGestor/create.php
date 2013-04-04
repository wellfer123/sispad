<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidade Gestors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UnidadeGestor', 'url'=>array('index')),
	array('label'=>'Manage UnidadeGestor', 'url'=>array('admin')),
);
?>

<h2>Cadastrar Unidade/Gestor</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
