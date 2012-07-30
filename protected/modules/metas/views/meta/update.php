<?php
$this->breadcrumbs=array(
         'Indicador'=>array('indicador/admin'),
	 'Metas'=>array('meta/view','indicador_id',$_GET['indicador_id']),
         'Atualização',
);

$this->menu=array(
	array('label'=>'Adicionar Meta', 'url'=>array("meta/create","indicador_id"=>$_GET['indicador_id'])),
);
?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Atualização da Meta '.$model->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form_update', array('model'=>$model,'cargos'=>$cargos)); ?>

<?php $this->endWidget(); ?>