<?php
$this->breadcrumbs=array(
        'Metas'=>array('admin'),
	'Executadas por Médicos'=>array('Admin'),
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