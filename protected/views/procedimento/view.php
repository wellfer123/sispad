<?php
$this->breadcrumbs=array(
	'Procedimentos'=>array('index'),
	$model->codigo,
);

$this->menu=array(
	array('label'=>'List Procedimento', 'url'=>array('index')),
	array('label'=>'Create Procedimento', 'url'=>array('create')),
	array('label'=>'Update Procedimento', 'url'=>array('update', 'id'=>$model->codigo)),
	array('label'=>'Delete Procedimento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Procedimento', 'url'=>array('admin')),
);
?>

<h1>View Procedimento #<?php echo $model->codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codigo',
		'nome',
		'tipo_complexidade',
		'tipo_sexo',
		'quantidade_maxima_execucao',
		'quantidade_dias_permanencia',
		'quantidade_pontos',
		'validade_idade_minima',
		'validade_idade_maxima',
		'validade_sh',
		'validade_sa',
		'validade_sp',
		'codigo_financiamento',
		'codigo_rubrica',
		'data_competencia',
	),
)); ?>
