<?php
$this->breadcrumbs=array(
	'Auxiliar Enfermagem Executa Metas'=>array('index'),
	$model->auxiliar_enfermagem_cpf,
);

$this->menu=array(
	array('label'=>'List auxiliar_enfermagem_executa_meta', 'url'=>array('index')),
	array('label'=>'Create auxiliar_enfermagem_executa_meta', 'url'=>array('create')),
	array('label'=>'Update auxiliar_enfermagem_executa_meta', 'url'=>array('update', 'id'=>$model->auxiliar_enfermagem_cpf)),
	array('label'=>'Delete auxiliar_enfermagem_executa_meta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->auxiliar_enfermagem_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage auxiliar_enfermagem_executa_meta', 'url'=>array('admin')),
);
?>

<h1>View auxiliar_enfermagem_executa_meta #<?php echo $model->auxiliar_enfermagem_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'auxiliar_enfermagem_cpf',
		'unidade_cnes',
		'meta_id',
		'total',
		'data_inicio',
		'data_fim',
	),
)); ?>
