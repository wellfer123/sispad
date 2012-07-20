<?php
$this->breadcrumbs=array(
	'Indicador'=>array('admin'),
	'Novo Indicador',
);

$this->menu=array(
	array('label'=>'Administrar Indicadores', 'url'=>array('admin')),
);


?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Criação de Indicador',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


<?php $this->endWidget(); ?>