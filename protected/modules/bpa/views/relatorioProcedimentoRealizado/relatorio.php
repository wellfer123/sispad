<?php
$this->breadcrumbs=array(
	'Procedimento Realizados'=>array('index'),
	'Relatórios',
);

?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Relatórios de Produção Ambulatorial',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_relatorio', array(
                                                    'model'=>$model,
                                                    'relatorios'=>$relatorios,
                                                    'competencias'=>$competencias,
                                                    'competencias_movimento'=>$competencias_movimento)); ?>
<?php $this->endWidget()?>
