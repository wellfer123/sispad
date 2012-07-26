<?php
$this->breadcrumbs=array(
	'Metas'=>array('Meta/admin'),
	'Executadas por Enfermeiro'=>array('admin'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Gerenciar Metas Executads por Enfermeiros', 'url'=>array('preparedAdmin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de meta executada por Enfermeiro',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>