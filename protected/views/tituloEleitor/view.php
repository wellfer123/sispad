<?php
$this->breadcrumbs=array(
	'Titulo Eleitors'=>array('index'),
	$model->servidor_cpf,
);

$this->menu=array(
	array('label'=>'Update TituloEleitor', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
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
