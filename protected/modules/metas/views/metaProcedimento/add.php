<?php
$this->breadcrumbs=array(
       'Indicador'=>array('indicador/admin'),
       'Metas'=>array('meta/view',"indicador_id"=>$_GET['indicador_id']),
       'Procedimentos'=>array('view','meta_id'=>$_GET['meta_id'],"indicador_id"=>$_GET['indicador_id']),
       'Adicionar',
);


?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Escolha de Procedimento',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
<?php $this->endWidget(); ?>