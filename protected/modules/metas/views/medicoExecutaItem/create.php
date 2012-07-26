<?php
$this->breadcrumbs=array(
	'Medico Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Escolher novo médico, meta ou competência', 'url'=>array('MedicoExecutaMeta/send')),
	array('label'=>'Gerenciamento de itens executados por médico', 'url'=>array('admin')),
);
?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de Itens executados',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', 
                                array('model'=>$model,'modelos'=>$modelos,'itens'=>$itens,'competencia'=>$competencia,'medico'=>$medico)); ?>

<?php $this->endWidget(); ?>