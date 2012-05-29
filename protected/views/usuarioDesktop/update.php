<?php
$this->breadcrumbs=array(
	'Usuários Desktop'=>array('admin'),
	$model->servidor->nome=>array('view','serial'=>$model->serial_aplicacao, 'id'=>$model->servidor_cpf),
	'Atualização',
);

$this->menu=array(
	array('label'=>'Cadastrar usuário desktop', 'url'=>array('create')),
	array('label'=>'Visualizar usuário desktop', 'url'=>array('view','serial'=>$model->serial_aplicacao, 'id'=>$model->servidor_cpf)),
	array('label'=>'Gerenciamento dos usuários desktop', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro de usuários desktop',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>