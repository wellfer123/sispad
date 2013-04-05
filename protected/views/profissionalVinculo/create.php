<?php
/* @var $this ProfissionalVinculoController */
/* @var $model ProfissionalVinculo */

$this->breadcrumbs=array(
	'Vínculo de Profissional',
);

$this->menu=array(
	array('label'=>'Enviar Produção Diária', 'url'=>array('producaoDiaria/send')),
	array('label'=>'Consultar Produção Diária', 'url'=>array('producaoDiaria/adminGestor')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Vínculo de Profissional',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'unidades'=>$unidades)); ?>
<?php $this->endWidget(); ?>
<?php echo $this->renderPartial('_list', array('dataProvider'=>$dataProvider)); ?>