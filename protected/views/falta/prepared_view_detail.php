<?php
$this->breadcrumbs=array(
	'Faltas'
);


?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Faltas Detalhadas',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_prepared', array('model'=>$model)); ?>
<?php $this->endWidget();?>
