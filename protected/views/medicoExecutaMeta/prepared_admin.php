<?php
$this->breadcrumbs=array(
	'Metas'=>array('admin'),
	'Executadas por Médicos'=>array('Admin'),
	'Escolher Competência',
);


?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Metas Executadas Por Médico',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_prepared_admin', array('model'=>$model)); ?>
<?php $this->endWidget();?>
