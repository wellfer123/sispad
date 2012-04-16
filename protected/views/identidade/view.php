<?php
$this->breadcrumbs=array(
	'Identidades'=>array('index'),
	$model->servidor_cpf,
);

$this->menu=array(
	array('label'=>'List Identidade', 'url'=>array('index')),
	array('label'=>'Create Identidade', 'url'=>array('create')),
	array('label'=>'Update Identidade', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
	array('label'=>'Delete Identidade', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->servidor_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Identidade', 'url'=>array('admin')),
);
?>

<h1>View Identidade #<?php echo $model->servidor_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'data_nascimento',
		'numero',
		'orgao_expedidor',
		'uf',
		'sexo',
		'estado_naturalidade_id',
		'cidade_naturalidade_id',
		'nome_pai',
		'nome_mae',
	),
)); ?>
