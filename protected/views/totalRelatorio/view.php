<?php
$this->breadcrumbs=array(
	'Quantidade de Relatórios'=>array('index'),
	$model->servidor->nome.' ',
	$model->mes.'/'.$model->ano,
);

$this->menu=array(
);
?>
<div class="update">
<h1>Relatório <?php echo ' '.$model->mes.'/'.$model->ano; ?></h1>
</div>

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
