<?php
$this->breadcrumbs=array(
'Enfermeiro Executa Metas'=>array('index'),
$model->enfermeiro_cpf,
);

$this->menu=array(
array('label'=>'List enfermeiro_executa_meta', 'url'=>array('index')),
array('label'=>'Create enfermeiro_executa_meta', 'url'=>array('create')),
array('label'=>'Update enfermeiro_executa_meta', 'url'=>array('update', 'id'=>$model->enfermeiro_cpf)),
array('label'=>'Delete enfermeiro_executa_meta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->enfermeiro_cpf),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage enfermeiro_executa_meta', 'url'=>array('admin')),
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
'data_inicio',
'data_fim',
),
)); ?>