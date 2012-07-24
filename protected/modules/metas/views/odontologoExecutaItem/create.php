<?php
$this->breadcrumbs=array(
	'Odontologo Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Escolher novo odontólogo, meta ou competência', 'url'=>array('OdontologoExecutaMeta/send')),
	array('label'=>'Gerenciamento de itens executados por odontólogo', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de Itens executados',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelos'=>$modelos,'itens'=>$itens,'competencia'=>$competencia,'odontologo'=>$odontologo)); ?>
<?php $this->endWidget(); ?>