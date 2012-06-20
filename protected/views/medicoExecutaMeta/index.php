<?php
$this->breadcrumbs=array(
	'Metas executadas por médicos'=>array('admin'),
);

$this->menu=array(
	array('label'=>'Enviar Nova Execução de Meta', 'url'=>array('create')),
	array('label'=>'Gerenciar Metas Executads por Médicos', 'url'=>array('admin')),
);
?>

<h2>Metas executadas por médicos.</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'medico-executa-meta-grid',
	'dataProvider'=>$model->search($medico),
	//'filter'=>$model,
	'columns'=>array(
		array(
                        'name'=>'Médico',
                        'value'=>'$data->medico->servidor->nome',
                ),
                'meta.nome',
                array(
                        'name'=>'Valor da Meta',
                        'value'=>'$data->meta->valor',
                ),
                array(
                        'name'=>'Total de execuções',
                        'value'=>'$data->total',
                ),
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
                'competencia',
	),
)); ?>
