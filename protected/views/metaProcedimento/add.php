<?php
$this->breadcrumbs=array(
	'Procedimento'=>array('index'),
	'Add',
);


?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Escolha de Procedimento',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
<?php $this->endWidget(); ?>