<?php
$this->breadcrumbs=array(
	'Quantidade de Relatórios'=>array('index'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Gerenciamento de Relatórios Enviados', 'url'=>array('admin')),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio da Quantidade de Relatórios',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget(); ?>
<?php echo $this->renderPartial('_list', array('model'=>$model)); ?>
