<?php
$this->breadcrumbs=array(
	'Servidors'=>array('index'),
	$model->cpf,
);

$this->menu=array(
	array('label'=>'Cadastrar Servidor', 'url'=>array('index')),
	array('label'=>'Atualizar Servidor', 'url'=>array('update', 'id'=>$model->cpf)),
	array('label'=>'Cadastrar Dados de Trabalho', 'url'=>array('DadosTrabalho/create','id'=>$model->cpf)),
	array('label'=>'Cadastrar Identidade', 'url'=>array('create')),
	array('label'=>'Cadastrar Título de Eleitor', 'url'=>array('create')),
	array('label'=>'Cadastrar Endereço', 'url'=>array('create')),
	array('label'=>'Gerenciamento de Servidores', 'url'=>array('admin')),
);
?>

<h1>View Servidor #<?php echo $model->cpf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cpf',
		'matricula',
		'nome',
		'estado_civil',
		'endereco_id',
		'unidade_cnes',
	),
)); ?>
