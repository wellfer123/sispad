<?php
$this->breadcrumbs=array(
	'EnfermeiroExecutaMetas'=>array('admin'),
	'Escolher Competência',
);


?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Metas Executadas Por Enfermeiro',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_prepared_admin', array('model'=>$model)); ?>
<?php $this->endWidget();?>
