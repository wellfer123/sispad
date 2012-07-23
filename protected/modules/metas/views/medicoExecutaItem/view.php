<?php
$this->breadcrumbs=array(
	'Medico Executa Items'=>array('index'),
	$model->medico_cpf,
);

$this->menu=array(
	array('label'=>'Listar itens executados pelo médico', 'url'=>array('list', 'unidade'=>$model->medico_unidade_cnes,'servidor'=>$model->medico_cpf)),
	array('label'=>'Gerenciamento de itens executados por médico', 'url'=>array('admin')),
);
?>


<div class="update">
   <h3>Item executado pelo médico <?php echo $model->medico->servidor->nome; ?></h3> 
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Médico',
                    'value'=>$model->medico->servidor->nome,
                ),
                array(
                    'label'=>'Unidade',
                    'value'=>$model->unidade->nome,
                ),
                array(
                    'label'=>'Meta',
                    'value'=>$model->item->meta->nome,
                ),
                array(
                    'label'=>'Item',
                    'value'=>$model->item->nome,
                ),
		'quantidade',
		'competencia',
	),
)); ?>
