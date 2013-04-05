<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidades Gestor'=>array('index'),
	$model->unidade_cnes=>array('view','id'=>$model->unidade_cnes),
	'Update',
);

$this->menu=array(
	array('label'=>'Cadastrar UnidadeGestor', 'url'=>array('create')),
	array('label'=>'Gerenciar UnidadeGestor', 'url'=>array('admin')),
);
?>

<h1>Atualizar UnidadeGestor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>