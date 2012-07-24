<?php
$this->breadcrumbs=array(
	'Agente de Saúde Executa Items'=>array('index'),
	$model->agente_saude_cpf,
);

$this->menu=array(
	array('label'=>'Listar itens executados pelo Agente de Saúde', 'url'=>array('list', 'unidade'=>$model->agente_saude_unidade_cnes,'servidor'=>$model->agente_saude_cpf)),
	array('label'=>'Gerenciamento de itens executados por Agente de Saúde', 'url'=>array('admin')),
);
?>


<div class="update">
   <h3>Item executado pelo Odontólogo <?php echo $model->agente_saude->servidor->nome; ?></h3> 
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Agente de Saúde',
                    'value'=>$model->agente_saude->servidor->nome,
                ),
                array(
                    'label'=>'Unidade',
                    'value'=>$model->agente_saude->servidor->unidade->nome,
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
