<?php
$this->breadcrumbs=array(
	'Medico Executa Items'=>array('index'),
	$model->medico_cpf,
);

$this->menu=array(
	array('label'=>'List medico_executa_item', 'url'=>array('index')),
	array('label'=>'Create medico_executa_item', 'url'=>array('create')),
	array('label'=>'Update medico_executa_item', 'url'=>array('update', 'id'=>$model->medico_cpf)),
	array('label'=>'Delete medico_executa_item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->medico_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage medico_executa_item', 'url'=>array('admin')),
);
?>

<h1>View medico_executa_item #<?php echo $model->medico_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'medico_cpf',
		'item_id',
		'medico_unidade_cnes',
		'quantidade',
		'competencia',
	),
)); ?>
