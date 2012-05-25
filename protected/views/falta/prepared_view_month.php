<?php
$this->breadcrumbs=array(
	'Faltas Mensais',
);


?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Faltas Mensais',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_prepared_month', array('model'=>$model)); ?>
<?php $this->endWidget();?>
