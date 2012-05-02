<?php
$this->breadcrumbs=array(
	'Faltas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List falta', 'url'=>array('index')),
	array('label'=>'Manage falta', 'url'=>array('admin')),
);
?>
<?php $servidor = Servidor::model()->findByPk($model->servidor_cpf);
      $mes = Meses::model()->findByPk($model->mes);
?>
<h1><?php echo 'Falta: '.$servidor->nome.' - '.$mes->nome.'/'.$model->ano ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>