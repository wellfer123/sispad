<?php
$this->breadcrumbs=array(
	'Quantidade de Relatórios'=>array('index'),
	$model->servidor->nome.' ',
	$model->mes.'/'.$model->ano,
);

$this->menu=array(
);
?>

<h1>Relatórios <?php echo ' '.$model->mes.'/'.$model->ano; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Servidor',
                    'value'=>$model->servidor->nome,
                 ),
		'quantidade',
		'ano',
		'mes',
		'data_envio',
	),
)); ?>
