<?php
$this->breadcrumbs=array(
	'Meta'=>array('admin'),
	'Agente Saude Executa Metas'=>array('admin'),
        'Visualização'
);

$this->menu=array(
	//array('label'=>'Listar Metas Executadas Por Agentes de Saúde', 'url'=>array('index')),
	array('label'=>'Enviar Nova Execução de Meta', 'url'=>array('create')),
	array('label'=>'Gerenciar Metas Executads por Agentes de Saúde', 'url'=>array('admin')),
);
?>
<div class="update">
<h3>Meta: <?php  echo $model->meta->nome.' executada por '.$model->agente_saude->servidor->nome; ?></h3>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		  array(
                        'label'=>'Indicador',
                        'value'=>$model->meta->indicador->nome
                ),
                array(
                        'label'=>'Meta',
                        'value'=>$model->meta->nome
                ),
                array(
                        'label'=>'Unidade',
                        'value'=>$model->agente_saude->unidade->nome
                ),
                array(
                        'label'=>'Médico',
                        'value'=>$model->agente_saude->servidor->nome
                ),
                array(
                        'label'=>'Valor da meta',
                        'value'=>$model->meta->valor
                ),
                array(
                        'label'=>'Total de execuções',
                        'value'=>$model->total
                ),
                array(
                        'label'=>'Status da Meta',
                        'value'=>$model->isMetaBatida(),
                ),
		//'competencia',
	),
)); ?>
