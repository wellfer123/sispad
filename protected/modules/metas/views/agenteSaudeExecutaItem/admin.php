<?php
$this->breadcrumbs=array(
	'Agente de Saúde Executa Itens'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Enviar nova execução de meta', 'url'=>array('AgenteSaudeExecutaMeta/send')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('agente_saude-executa-item-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciamento de itens executados por Agentes de Saúde</h1>

<p>
Você pode opcionalmente entrar com um operador de comparação(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) iniciar cada uma de suas pesquisa com valores específicos de como a comparação deve ser feita.
</p>

<?php echo CHtml::link('Pesquisa avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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
