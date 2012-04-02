<?php
$this->breadcrumbs=array(
	'Usuários'=>array('index'),
	$model->username,
);


?>

<h1>Usuário: <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'username',
                array(
                      'label'=>'Servidor',
                      'value'=>$model->servidor->nome,
                )
	),
)); ?>
