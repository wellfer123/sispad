<?php
$this->breadcrumbs=array(
	'Meta'=>array('admin'),
	'Agente Saude Executa Metas'=>array('admin'),
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