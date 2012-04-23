<?php
$this->breadcrumbs=array(
	'Indicador'=>array('index'),
	'Create',
);


?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Criação de Indicador',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>