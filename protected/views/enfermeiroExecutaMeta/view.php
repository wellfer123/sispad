<?php
$this->breadcrumbs=array(
        'Metas'=>array('Meta/admin'),
	'Executadas por Enfermeiro'=>array('admin'),
        'Visualização',
);

$this->menu=array(
    array('label'=>'Listar Metas Executadas Por Enfermeiro', 'url'=>array('index')),
    array('label'=>'Enviar Nova Execução de Meta', 'url'=>array('send')),
    array('label'=>'Gerenciar Metas Executadas Por Enfermeiro ', 'url'=>array('admin')),
);
?>



<div class="update">
    <h3>Meta: <?php echo $model->meta->nome.' executada por '.$model->enfermeiro->servidor->nome; ?></h3>
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
                        'value'=>$model->enfermeiro->unidade->nome
                ),
                array(
                        'label'=>'Médico',
                        'value'=>$model->enfermeiro->servidor->nome
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