<?php
$this->breadcrumbs=array(
	'Usuários'=>array('index'),
	'Registro',
);


?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Registro de Usuário',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>