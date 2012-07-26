<?php
$this->breadcrumbs=array(
        'Servidor'=>array('Servidor/view','id'=>$servidor->cpf),
	'Titulo de Eleitor'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'Visualizar Servidor', 'url'=>array('Servidor/view','id'=>$servidor->cpf)),
	//array('label'=>'Manage TituloEleitor', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro do Título de Eleitor de '.$servidor->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'servidor'=>$servidor)); ?>

<?php $this->endWidget(); ?>