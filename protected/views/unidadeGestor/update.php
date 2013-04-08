<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidade Gestor'=>array('index'),
	$model->unidade_cnes=>array('view','id'=>$model->unidade_cnes),
	'Atualizar',
);

$this->menu=array(
	array('label'=>'Cadastrar Unidade/Gestor', 'url'=>array('create')),
	array('label'=>'Gerenciar Unidade/Gestor', 'url'=>array('admin')),
);
?>

<h1>Atualizar Unidade/Gestor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>