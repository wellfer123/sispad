<?php
$this->breadcrumbs=array(
	'Faltas'=>array('Falta/preparedViewDetail'),
	'Enviar Faltas',
);


?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Metas Executadas Por Odontologo',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_prepared_admin', array('model'=>$model)); ?>
<?php $this->endWidget();?>
