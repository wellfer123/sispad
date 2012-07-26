<?php
$this->breadcrumbs=array(
	'Metas'=>array('admin'),
	'Executadas por Médicos'=>array('Admin'),
        'Listagem',
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
                        'name'=>'Medico',
                        'value'=>'$data->medico->servidor->nome',
                ),
                array(
                        'name'=>'Unidade',
                        'value'=>'$data->unidade_medico->nome',
                ),
                'meta.nome',
                array(
                        'name'=>'Valor da Meta',
                        'value'=>'$data->meta->valor',
                ),
                array(
                        'name'=>'Total',
                        'value'=>'$data->total',
                ),
                array(
                        'name'=>'Status da Meta',
                        'value'=>'$data->isMetaBatida()',
                ),
                'competencia',
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
