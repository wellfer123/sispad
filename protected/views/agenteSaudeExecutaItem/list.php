<?php
$this->breadcrumbs=array(
	'Agente de Saúde Executa Items',
);

$this->menu=array(
	array('label'=>'Enviar nova execução de meta', 'url'=>array('AgenteSaudeExecutaMeta/send')),
	array('label'=>'Gerenciamento de itens executados por Agente de Saúde', 'url'=>array('admin')),
);
?>

<h1>Itens executados por Agente de Saúde</h1>

<?php echo $this->renderMessages(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'agente_saude-executa-item-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                        'name'=>'Agente de Saúde',
                        'value'=>'$data->agente_saude->servidor->nome',
                ),
                array(
                        'name'=>'Unidade',
                        'value'=>'$data->agente_saude->servidor->unidade->nome',
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
                                                'url'=> 'Yii::app()->createUrl("/AgenteSaudeExecutaItem/view",
                                                        array("servidor"=>$data->agente_saude_cpf,"item"=>$data->item_id,"competencia"=>$data->competencia,"unidade"=>$data->agente_saude_unidade_cnes))',
                                ),
                        )
		),
	),
)); ?>
