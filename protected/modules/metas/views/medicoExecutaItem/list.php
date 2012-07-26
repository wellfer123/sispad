<?php
$this->breadcrumbs=array(
	'Medico Executa Items',
);

$this->menu=array(
	array('label'=>'Enviar nova execução de meta', 'url'=>array('MedicoExecutaMeta/send')),
	array('label'=>'Gerenciamento de itens executados por médico', 'url'=>array('admin')),
);
?>

<h1>Itens executados por médico</h1>

<?php echo $this->renderMessages(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'medico-executa-item-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                        'name'=>'Médico',
                        'value'=>'$data->medico->servidor->nome',
                ),
                array(
                        'name'=>'Unidade',
                        'value'=>'$data->unidade->nome',
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
                                                'url'=> 'Yii::app()->createUrl("/MedicoExecutaItem/view",
                                                        array("servidor"=>$data->medico_cpf,"item"=>$data->item_id,"competencia"=>$data->competencia,"unidade"=>$data->medico_unidade_cnes))',
                                ),
                        )
		),
	),
)); ?>
