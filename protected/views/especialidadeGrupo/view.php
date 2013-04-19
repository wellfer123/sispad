<?php
/* @var $this EspecialidadeGrupoController */
/* @var $model EspecialidadeGrupo */

$this->breadcrumbs=array(
	'Especialidade Grupo'=>array('admin'),
	$model->profissao_codigo,
);

$this->menu=array(
	array('label'=>'Cadastrar Especialidade/Grupo', 'url'=>array('create')),
	array('label'=>'Atualizar Especialidade/Grupo', 'url'=>array('update','profissao_codigo'=>$model->profissao_codigo,'grupo_codigo'=>$model->grupo_codigo)),
	array('label'=>'Deletar Especialidade/Grupo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','profissao_codigo'=>$model->profissao_codigo,'grupo_codigo'=>$model->grupo_codigo),'confirm'=>'Deseja realmente excluir esse item?')),
	array('label'=>'Gerenciar Especialidade/Grupo', 'url'=>array('admin')),
);
?>

<h1>Vizualizar Especialidade/Grupo</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'name'=>'profissao_codigo',
                    'value'=>$model->especialidade->nome,
                ),
                array(
                    'name'=>'grupo_codigo',
                    'value'=>$model->grupo->nome,
                ),
	),
)); ?>
