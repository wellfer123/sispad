<?php
$this->breadcrumbs=array(
	'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
        'Identidade',
	'Atualização',
);

$this->menu=array(
	array('label'=>'Ver identidade', 'url'=>array('view', 'id'=>$model->servidor_cpf)),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Atualização da identidade '.$model->servidor->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>