<?php
$this->breadcrumbs=array(
	'Servidors'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Cadastrar Servidor', 'url'=>array('index')),
	array('label'=>'Atualizar Servidor', 'url'=>array('update', 'id'=>$model->cpf)),
	array('label'=>'Dados de Trabalho', 'url'=>array('DadosTrabalho/index','id'=>$model->cpf)),
	array('label'=>'Identidade', 'url'=>array('Identidade/index','id'=>$model->cpf)),
	array('label'=>'Título de Eleitor', 'url'=>array('TituloEleitor/index','id'=>$model->cpf)),
	array('label'=>'Endereço', 'url'=>array('Endereco/index','id'=>$model->cpf)),
	array('label'=>'Gerenciamento de Servidores', 'url'=>array('admin')),
);
?>

<div class="update">
<h2>Servidor: <?php echo $model->nome; ?> </h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cpf',
		'matricula',
		'estado_civil',
		'endereco_id',
		'unidade_cnes',
	),
)); ?>

</div>
