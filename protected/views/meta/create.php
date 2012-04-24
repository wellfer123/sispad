<?php
$this->breadcrumbs=array(
	'Meta'=>array('index'),
	'Create',
);


?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Criação de Meta',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php echo $this->renderPartial('_admin', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>