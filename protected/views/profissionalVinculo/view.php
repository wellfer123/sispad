<?php
/* @var $this ProfissionalVinculoController */
/* @var $model ProfissionalVinculo */

$this->breadcrumbs=array(
	'Profissional Vinculos'=>array('index'),
	$model->cpf,
);

$this->menu=array(
	array('label'=>'List ProfissionalVinculo', 'url'=>array('index')),
	array('label'=>'Create ProfissionalVinculo', 'url'=>array('create')),
	array('label'=>'Update ProfissionalVinculo', 'url'=>array('update', 'id'=>$model->cpf)),
	array('label'=>'Delete ProfissionalVinculo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProfissionalVinculo', 'url'=>array('admin')),
);
?>

<h1>View ProfissionalVinculo #<?php echo $model->cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cpf',
		'unidade_cnes',
		'codigo_profissao',
	),
)); ?>
