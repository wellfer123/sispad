<?php
$this->breadcrumbs=array(
	'Competências'=>array('admin'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'Listar Competencias', 'url'=>array('index')),
	array('label'=>'Gerenciar Competencias', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro de competência',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>