<?php
$this->breadcrumbs=array(
        'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
	'Dados do Trabalho',
	'Cadastro',
);


?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro de dados de trabalho do servidor: ',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>