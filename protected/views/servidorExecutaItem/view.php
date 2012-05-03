<?php
$this->breadcrumbs=array(
	'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
        'Itens Executados'=>array('ServidorExecutaItem/send'),
        //'Dados de Trabalho de42 3 '.$model->servidor->nome,
);

$this->menu=array(
	array('label'=>'Enviar mais itens executados', 'url'=>array('send')),
);
?>
<div class="update">
<h3>Item executado por <?php echo $model->servidor->nome; ?></h3>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Servidor',
                    'type'=>'raw',
                    'value'=>  CHtml::link($model->servidor->nome, array('Servidor/view','id'=>$model->servidor_cpf)),
                ),
                array(
                    'label'=>'Item',
                    'value'=>$model->item->nome,
                ),
		'total',
		'data_inicio',
		'data_fim',
	),
)); ?>

