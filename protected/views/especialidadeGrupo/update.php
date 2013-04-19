<?php
/* @var $this EspecialidadeGrupoController */
/* @var $model UnidadeGrupo */

$this->breadcrumbs=array(
	'Especialidade Grupo'=>array('admin'),
	$model->profissao_codigo=>array('view','profissao_codigo'=>$model->profissao_codigo,'grupo_codigo'=>$model->grupo_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'Cadastrar Especialidade/Grupo', 'url'=>array('create')),
	array('label'=>'Vizualizar Especialidade/Grupo', 'url'=>array('view', 'profissao_codigo'=>$model->profissao_codigo,'grupo_codigo'=>$model->grupo_codigo)),
	array('label'=>'Gerenciar Especialidade/Grupo', 'url'=>array('admin')),
);
?>

<h1>Atualizar Especialidade/Grupo </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>