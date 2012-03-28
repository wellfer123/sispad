<?php
$this->breadcrumbs=array(
	'Total de Frequências'=>array('index'),
        $model->servidor->nome.' ',
	$model->mes.'/'.$model->ano,
);

$this->menu=array(
	array('label'=>'Gerenciar Frequências', 'url'=>array('admin')),
);
?>

<h1>Frequência <?php echo ' '.$model->mes.'/'.$model->ano; ?></h1>

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
