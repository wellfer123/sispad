<?php
$this->breadcrumbs=array(
	'Metas executadas por Agentes de Saúde'=>array('preparedAdmin'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Gerenciar Metas Executads por Agentes de Saúde', 'url'=>array('preparedAdmin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de meta executada por Agente de Saúde',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>