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
			'title'=>'Lançamento de metas',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_calculo', array('profissoes'=>$profissoes,'tiposMeta'=>$tiposMeta,'competencias'=>CHtml::listData(Competencia::model()->findAll(), 'mes_ano', 'mes_ano'))); ?>
    
<?php $this->endWidget(); ?>
