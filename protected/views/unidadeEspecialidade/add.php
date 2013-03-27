<?php
/* @var $this UnidadeEspecialidadeController */
/* @var $model UnidadeEspecialidade */

$this->breadcrumbs=array(
	'Unidade'=>array('unidade/view','id'=>$model->unidade_cnes),
	$unidade->nome,
	'Especialidade',
);

$this->menu=array(
	array('label'=>'Ver Unidade', 'url'=>array('unidade/view','id'=>$model->unidade_cnes)),
        array('label'=>'Enviar Produção Diária', 'url'=>array('producaoDiaria/create')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Adicionar especialidades na unidade '.$unidade->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>


<?php echo $this->renderPartial('_addEspecialidade', array('model'=>$model,'unidade'=>$unidade,'grupos'=>$grupos)); ?>


<?php $this->endWidget(); ?>

<?php $this->renderPartial('_especialidades', array('model' => $model)); ?>