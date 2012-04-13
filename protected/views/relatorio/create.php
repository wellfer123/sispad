<?php
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Relatórios', 'url'=>array('index')),
	array('label'=>'Gerenciamento de relatórios', 'url'=>array('admin')),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio de Relatório',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget(); ?>