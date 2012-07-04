<?php
$this->breadcrumbs=array(
	'Odontologo Executa Items'=>array('index'),
	$model->odontologo_cpf,
);

$this->menu=array(
	array('label'=>'Listar itens executados pelo Odontólogo', 'url'=>array('list', 'unidade'=>$model->odontologo_unidade_cnes,'servidor'=>$model->odontologo_cpf)),
	array('label'=>'Gerenciamento de itens executados por Odontólogo', 'url'=>array('admin')),
);
?>


<div class="update">
   <h3>Item executado pelo Odontólogo <?php echo $model->odontologo->servidor->nome; ?></h3> 
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Odontólogo',
                    'value'=>$model->odontologo->servidor->nome,
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
