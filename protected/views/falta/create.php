<?php
$this->breadcrumbs=array(
	'Faltas'=>array('Falta/preparedViewDetail'),
	'Enviar Faltas '=>array('Falta/preparedCreate'),
        'Envio'
);

$this->menu=array(
	array('label'=>'Escolher outro Servidor ou Data', 'url'=>array('preparedCreate')),
);
?>
<?php $servidor = Servidor::model()->findByPk($model->servidor_cpf);
      $mes = Meses::model()->findByPk($model->mes);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Servidor: $servidor->nome Falta:$mes->nome/$model->ano",
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget();?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>

