<?php
$this->breadcrumbs=array(
	'Metas executadas por odontologos'=>array('admin'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Gerenciar Metas Executads por Odontologos', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de meta executada por odontólogo',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>