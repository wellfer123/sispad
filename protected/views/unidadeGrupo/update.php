<?php
/* @var $this UnidadeGrupoController */
/* @var $model UnidadeGrupo */

$this->breadcrumbs=array(
	'Unidade Grupo'=>array('admin'),
	$model->unidade_cnes=>array('view','unidade_cnes'=>$model->unidade_cnes,'grupo_codigo'=>$model->grupo_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'Cadastrar Unidade/Grupo', 'url'=>array('create')),
	array('label'=>'Vizualizar Unidade/Grupo', 'url'=>array('view', 'unidade_cnes'=>$model->unidade_cnes,'grupo_codigo'=>$model->grupo_codigo)),
	array('label'=>'Gerenciar Unidade/Grupo', 'url'=>array('admin')),
);
?>

<h1>Atualizar Unidade/Grupo </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>