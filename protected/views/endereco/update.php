<?php
$this->breadcrumbs=array(
        'Servidor'=>array('Servidor/view','id'=>$servidor->cpf),
	'Endereço'=>array('view','id'=>$model->id),
	'Atuaização',
);

$this->menu=array(
	array('label'=>'Visualizar Servidor', 'url'=>array('Servidor/view','id'=>$servidor->cpf)),
	array('label'=>'Visualizar Endereço', 'url'=>array('view', 'id'=>$model->id,'cpf'=>$servidor->cpf)),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro de Endereço de '.$servidor->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'servidor'=>$servidor)); ?>

<?php $this->endWidget(); ?>