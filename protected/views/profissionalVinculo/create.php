<?php
/* @var $this ProfissionalVinculoController */
/* @var $model ProfissionalVinculo */

$this->breadcrumbs=array(
	'Vínculo de Profissional',
);

$this->menu=array(
	
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Vínculo de Profissional/'.$unidade,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'unidade'=>$unidade)); ?>
<?php $this->endWidget(); ?>
<?php echo $this->renderPartial('_list', array('dataProvider'=>$dataProvider)); ?>