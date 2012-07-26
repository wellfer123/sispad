<?php
$this->breadcrumbs=array(
	'Metas'=>array('Meta/admin'),
	'Executas por Agente de Saúde'=>array('admin'),
	'Envio',

);

$this->menu=array(
	array('label'=>'Gerenciar Metas Executads por Agentes de Saúde', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de meta executada por Agente de Saúde',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>