<?php
$this->breadcrumbs=array(
	'Medico Executa Metas'=>array('index'),
	$model->medico_cpf,
);

$this->menu=array(
	array('label'=>'List medico_executa_meta', 'url'=>array('index')),
	array('label'=>'Create medico_executa_meta', 'url'=>array('create')),
	array('label'=>'Update medico_executa_meta', 'url'=>array('update', 'id'=>$model->medico_cpf)),
	array('label'=>'Delete medico_executa_meta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->medico_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage medico_executa_meta', 'url'=>array('admin')),
);
?>

<h1>View medico_executa_meta #<?php echo $model->medico_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'medico_cpf',
		'unidade_cnes',
		'meta_id',
		'total',
		'data_inicio',
		'data_fim',
	),
)); ?>
