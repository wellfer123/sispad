<?php
$this->breadcrumbs=array(
	'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
	'Dados do Trabalho',
	'Atualização',
);

$this->menu=array(
	array('label'=>'Ver dados do trabalho', 'url'=>array('view', 'id'=>$model->servidor_cpf)),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Atualização dos dados de trabalho de '.$model->servidor->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>