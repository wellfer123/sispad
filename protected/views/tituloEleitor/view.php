<?php
$this->breadcrumbs=array(
	'Titulo Eleitors'=>array('index'),
	$model->servidor_cpf,
);

$this->menu=array(
	array('label'=>'List TituloEleitor', 'url'=>array('index')),
	array('label'=>'Create TituloEleitor', 'url'=>array('create')),
	array('label'=>'Update TituloEleitor', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
	array('label'=>'Delete TituloEleitor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->servidor_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TituloEleitor', 'url'=>array('admin')),
);
?>

<h1>View TituloEleitor #<?php echo $model->servidor_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'numero',
		'zona',
		'secao',
	),
)); ?>
