<?php
$this->breadcrumbs=array(
        'Indicador'=>array('indicador/admin'),
	'Meta',
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