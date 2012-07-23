<?php
$this->breadcrumbs=array(
         'Indicador'=>array('indicador/admin'),
	 'Metas'=>array('meta/view','indicador_id',$_GET['indicador_id']),
);

$this->menu=array(
	array('label'=>'Adicionar Meta', 'url'=>array("meta/create","indicador_id"=>$_GET['indicador_id'])),
);
?>

<h1>Update da Meta <?php echo $model->nome; ?></h1>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Atualização de Meta',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>