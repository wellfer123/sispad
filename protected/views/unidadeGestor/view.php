<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidade Gestor'=>array('index'),
	$model->unidade_cnes,
);

$this->menu=array(
	array('label'=>'Cadastrar Unidade/Gestor', 'url'=>array('create')),
	array('label'=>'Atualizar Unidade/Gestor', 'url'=>array('update',"unidade_cnes"=>$model->unidade_cnes,"servidor_cpf"=>$model->servidor_cpf)),
	array('label'=>'Gerenciar Unidade/Gestor', 'url'=>array('admin')),
);
?>

<h1>Visualizar Unidade/Gestor</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                 array(
                    'name'=>'servidor',
                    'value'=>$model->servidor->nome
                ),
                 array(
                    'name'=>'unidade',
                    'value'=>$model->unidade->nome
                ),
                 array(
                    'name'=>'Status',
                    'value'=>$model->labelStatus(),
                ),
	),
)); ?>
