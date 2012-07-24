<?php
$this->breadcrumbs=array(
	'Competencias'=>array('index'),
	$model->mes_ano,
);

$this->menu=array(
	array('label'=>'Listar Competencias', 'url'=>array('index')),
	array('label'=>'Criar Competencia', 'url'=>array('create')),
	array('label'=>'Administrar Competencias', 'url'=>array('admin')),
);
?>

<h1>Competencia <?php echo $model->mes_ano; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mes_ano',
		array(
                    'name'=>'Status',
                    'value'=>$model->labelStatus(),
                ),
	),
)); ?>
