<?php
$nomeServidor = $_GET['serv'];
$this->breadcrumbs=array(
        'Servidor'=>array('Servidor/view','id'=>$servidor->cpf),
	'Endereco de '.$servidor->nome,

);

$this->menu=array(
        array('label'=>'Visualizar Servidor', 'url'=>array('Servidor/view','id'=>$servidor->cpf)),
	array('label'=>'Atualizar Endereço', 'url'=>array('update', 'id'=>$model->id,'cpf'=>$servidor->cpf)),
);
?>

<div class="update">
<h2>Endereco de <?php echo $servidor->nome; ?></h2>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'logradouro',
		'numero',
		'complemento',
		'bairro',
		'cidade_id',
		'telefone',
		'email',
	),
)); ?>
