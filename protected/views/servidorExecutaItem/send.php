<?php
$this->breadcrumbs=array(
	'Servidor'=>array('index'),
	'Itens de metas',
);

$this->menu=array(
	array('label'=>'List DadosTrabalho', 'url'=>array('index')),
	array('label'=>'Manage DadosTrabalho', 'url'=>array('admin')),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de Itens de Meta Executados: ',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>