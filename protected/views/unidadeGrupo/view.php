<?php
/* @var $this UnidadeGrupoController */
/* @var $model UnidadeGrupo */

$this->breadcrumbs=array(
	'Unidade Grupo'=>array('admin'),
	$model->unidade_cnes,
);

$this->menu=array(
	array('label'=>'Cadastrar Unidade/Grupo', 'url'=>array('create')),
	array('label'=>'Atualizar Unidade/Grupo', 'url'=>array('update','unidade_cnes'=>$model->unidade_cnes,'grupo_codigo'=>$model->grupo_codigo)),
	array('label'=>'Deletar Unidade/Grupo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','unidade_cnes'=>$model->unidade_cnes,'grupo_codigo'=>$model->grupo_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar Unidade/Grupo', 'url'=>array('admin')),
);
?>

<h1>Vizualizar Unidade/Grupo</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'name'=>'unidade_cnes',
                    'value'=>$model->unidade->nome,
                ),
                array(
                    'name'=>'grupo_codigo',
                    'value'=>$model->grupo->nome,
                ),
	),
)); ?>
