<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Escolher novo enfermeiro, meta ou competência', 'url'=>array('EnfermeiroExecutaMeta/send')),
	array('label'=>'Gerenciamento de itens executados por Enfermeiro', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de Itens executados',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelos'=>$modelos,'itens'=>$itens,'competencia'=>$competencia,'enfermeiro'=>$enfermeiro)); ?>
<?php $this->endWidget(); ?>