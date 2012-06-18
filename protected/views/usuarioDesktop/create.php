<?php
$this->breadcrumbs=array(
	'Usuários Desktop'=>array('admin'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Gerenciamente de usuários Desktop', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro de usuários desktop',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>