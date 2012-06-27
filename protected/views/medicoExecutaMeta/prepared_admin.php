<?php
$this->breadcrumbs=array(
	'MedicoExecutaMetas'=>array('admin'),
	'Escolher Competência',
);


?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Metas Executadas Por Médico',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_prepared_admin', array('model'=>$model)); ?>
<?php $this->endWidget();?>
