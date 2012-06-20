<?php
$this->breadcrumbs=array(
	'Metas executadas por médicos'=>array('admin'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Gerenciar Metas Executads por Médicos', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de meta executada por médico',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>