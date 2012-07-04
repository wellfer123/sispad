<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Items',
);

$this->menu=array(
	array('label'=>'Enviar nova execução de meta', 'url'=>array('EnfermeiroExecutaMeta/send')),
	array('label'=>'Gerenciamento de itens executados por Enfermeiro', 'url'=>array('admin')),
);
?>

<h1>Itens executados por Enfermeiro</h1>

<?php echo $this->renderMessages(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'enfermeiro-executa-item-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                        'name'=>'Enfermeiro',
                        'value'=>'$data->enfermeiro->servidor->nome',
                ),
                array(
                        'name'=>'Unidade',
                        'value'=>'$data->enfermeiro->servidor->unidade->nome',
                ),
                array(
                        'name'=>'Item',
                        'value'=>'$data->item->nome',
                ),
		'quantidade',
		'competencia',
                array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                                'delete'=>array(
                                                'visible'=>'false',
                                ),
                                'update'=>array(
                                                'visible'=>'false',
                                ),
                                'view'=>array(
                                                'url'=> 'Yii::app()->createUrl("/EnfermeiroExecutaItem/view",
                                                        array("servidor"=>$data->enfermeiro_cpf,"item"=>$data->item_id,"competencia"=>$data->competencia,"unidade"=>$data->enfermeiro_unidade_cnes))',
                                ),
                        )
		),
	),
)); ?>
