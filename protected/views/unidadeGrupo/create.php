<?php
/* @var $this UnidadeGrupoController */
/* @var $model UnidadeGrupo */

$this->breadcrumbs=array(
	'Unidade Grupo'=>array('index'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Lista Unidade/Grupo', 'url'=>array('index')),
	array('label'=>'Gerencia Unidade/Grupo', 'url'=>array('admin')),
);
?>

<h1>Cadastrar Unidade/Grupo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>