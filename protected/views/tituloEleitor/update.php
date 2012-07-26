<?php
$this->breadcrumbs=array(
	'Servidor'=>array('Servidor/view','id'=>$servidor->cpf),
	'Titulo de Eleitor'=>array('index'),
	'Atualização',
);

$this->menu=array(
	array('label'=>'Visualizar Servidor', 'url'=>array('Servidor/view','id'=>$servidor->cpf)),
	array('label'=>'Visualizar Título de Eleitor', 'url'=>array('view')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Atualização do Título de Eleitor de '.$servidor->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'servidor'=>$servidor)); ?>

<?php $this->endWidget(); ?>