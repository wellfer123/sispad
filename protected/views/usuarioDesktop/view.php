<?php
$this->breadcrumbs=array(
	'Usuarios Desktop'=>array('index'),
	$model->servidor_cpf,
);

$this->menu=array(
	array('label'=>'Cadastrar usuário desktop', 'url'=>array('create')),
	array('label'=>'Atualizar usuário desktop', 'url'=>array('update','serial'=>$model->serial_aplicacao, 'id'=>$model->servidor_cpf)),
	array('label'=>'Gerenciamento dos usuários desktop', 'url'=>array('admin')),
);
?>

<div class="update">
<h1>Usuário Desktop <?php echo $model->servidor->nome; ?></h1>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'token',
		'serial_aplicacao',
	),
)); ?>
