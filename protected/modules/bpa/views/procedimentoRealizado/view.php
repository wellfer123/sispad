<?php
$this->breadcrumbs=array(
	'Procedimento Realizados'=>array('index'),
	$model->unidade,
);

$this->menu=array(
	array('label'=>'List ProcedimentoRealizado', 'url'=>array('index')),
	array('label'=>'Create ProcedimentoRealizado', 'url'=>array('create')),
	array('label'=>'Update ProcedimentoRealizado', 'url'=>array('update', 'id'=>$model->unidade)),
	array('label'=>'Delete ProcedimentoRealizado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->unidade),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProcedimentoRealizado', 'url'=>array('admin')),
);
?>

<h1>View ProcedimentoRealizado #<?php echo $model->unidade; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'unidade',
		'competencia',
		'profissional_cns',
		'profissional_cbo',
		'folha',
		'sequencia',
		'procedimento',
		'paciente_cns',
		'data_atendimento',
		'cid',
		'quantidade',
		'caracter_atendimento',
		'numero_autorizacao',
		'origem',
		'competencia_movimento',
		'servico',
		'equipe',
		'classificacao',
		'data_cadastro',
	),
)); ?>
