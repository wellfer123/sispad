<?php
$this->breadcrumbs=array(
	'Dados Trabalhos'=>array('index'),
	$model->servidor_cpf,
);

$this->menu=array(
	array('label'=>'List DadosTrabalho', 'url'=>array('index')),
	array('label'=>'Create DadosTrabalho', 'url'=>array('create')),
	array('label'=>'Update DadosTrabalho', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
	array('label'=>'Delete DadosTrabalho', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->servidor_cpf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DadosTrabalho', 'url'=>array('admin')),
);
?>

<h1>View DadosTrabalho #<?php echo $model->servidor_cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'data_admissao',
		'pis',
		'carga_horaria',
		'turno',
		'profissao',
		'salario',
		'conselho_classe',
		'data_afastamento',
		'data_retorno',
		'situacao_funcional',
		'vinculo',
	),
)); ?>
