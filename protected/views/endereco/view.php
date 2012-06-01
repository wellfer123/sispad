<?php
$nomeServidor = $_GET['serv'];
$this->breadcrumbs=array(
        'Servidor'=>array('Servidor/view','id'=>$_GET['cpf']),
	'Endereco de '.$nomeServidor,

);

$this->menu=array(
	array('label'=>'List Endereco', 'url'=>array('index')),
	array('label'=>'Create Endereco', 'url'=>array('create')),
	array('label'=>'Update Endereco', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Endereco', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Endereco', 'url'=>array('admin')),
);
?>

<h1>Endereco de <?php echo $nomeServidor; ?></h1>

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
