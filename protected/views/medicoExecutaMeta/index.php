<?php
$this->breadcrumbs=array(
	'Medico Executa Metas',
);

$this->menu=array(
	array('label'=>'Enviar Nova Meta', 'url'=>array('create')),
	array('label'=>'Gerenciar Metas Executads por Médicos', 'url'=>array('admin')),
);
?>

<h1>Metas executadas por médicos.</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'medico-executa-meta-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
                array(
                        'name'=>'Medico',
                        'value'=>'$data->medico->servidor->nome',
                ),
                'meta.nome',
		'total',
                'meta.valor',
                array(
                        'name'=>'Status da Meta',
                        'value'=>'$data->isMetaBatida()',
                ),
		array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                                'delete'=>array(
                                                'visible'=>'false',
                                ),
                                'update'=>array(
                                                'visible'=>'false',
                                )
                        )
		),
	),
)); ?>
