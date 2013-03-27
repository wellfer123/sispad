<?php
$this->breadcrumbs=array(
	'Registro',
);


?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Registro de Usuário',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_frontend', array('model'=>$model)); ?>
<?php $this->endWidget(); ?>