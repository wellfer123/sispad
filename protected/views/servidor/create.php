<?php
$this->breadcrumbs=array(
	'Servidors'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'Gerenciamento de Servidores', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro de Servidor',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>