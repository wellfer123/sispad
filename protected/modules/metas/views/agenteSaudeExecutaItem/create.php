<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Escolher novo agente de saúde, meta ou competência', 'url'=>array('AgenteSaudeExecutaMeta/send')),
	array('label'=>'Gerenciamento de itens executados por Agente de Saúde', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de Itens executados',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelos'=>$modelos,'itens'=>$itens,'competencia'=>$competencia,'agenteSaude'=>$agenteSaude)); ?>
<?php $this->endWidget(); ?>