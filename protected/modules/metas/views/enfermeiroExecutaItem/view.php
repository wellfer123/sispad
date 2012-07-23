<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Items'=>array('index'),
	$model->enfermeiro_cpf,
);

$this->menu=array(
	array('label'=>'Listar itens executados pelo Enfermeiro', 'url'=>array('list', 'unidade'=>$model->enfermeiro_unidade_cnes,'servidor'=>$model->enfermeiro_cpf)),
	array('label'=>'Gerenciamento de itens executados por Enfermeiro', 'url'=>array('admin')),
);
?>


<div class="update">
   <h3>Item executado pelo Odontólogo <?php echo $model->enfermeiro->servidor->nome; ?></h3> 
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Enfermeiro',
                    'value'=>$model->enfermeiro->servidor->nome,
                ),
                array(
                    'label'=>'Unidade',
                    'value'=>$model->enfermeiro->servidor->unidade->nome,
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
