<?php
$this->breadcrumbs=array(
	'Faltas'=>array('index'),
	'Prepared Create',
);


?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Faltas',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_prepared', array('model'=>$model)); ?>
<?php $this->endWidget();?>