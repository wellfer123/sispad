<?php
$this->breadcrumbs=array(
        'Metas'=>array('admin'),
	'Executadas por Médicos'=>array('Admin'),
        'Visualização',
//	$model->medico->servidor->nome,
);

$this->menu=array(
        //array('label'=>'Listar Metas executadas Por Médico', 'url'=>array('index','medico'=>$model->medico_cpf)),
        array('label'=>'Enviar Nova Execução de Meta', 'url'=>array('create')),
	array('label'=>'Gerenciar Metas Executads por Médicos', 'url'=>array('admin')),
);
?>

<div class="update">
<h3>Meta: <?php  echo $model->meta->nome.' executada por '.$model->medico->servidor->nome; ?></h3>
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
                        'value'=>$model->unidade_medico->nome
                ),
                array(
                        'label'=>'Médico',
                        'value'=>$model->medico->servidor->nome
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
		'competencia',
	),
)); ?>
