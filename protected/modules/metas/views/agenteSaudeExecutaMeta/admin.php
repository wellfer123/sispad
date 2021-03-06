<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$this->breadcrumbs=array(
	'Metas'=>array('Meta/admin'),
	'Executadas por Agente de Saúde'=>array('admin'),
	'Gerenciamento',
);

$this->menu=array(
	array('label'=>'Enviar Nova Execução de Meta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-relatorio').click(function(){
	$('.search-form-relatorio').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('agente-saude-executa-meta-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Gerenciamento de Metas Executadas por Agente de Saúde</h2>

<p>
Você pode opcionalmente entrar com um operador de comparação(<, <=, >, >=, <> ou =) iniciar cada uma de
suas pesquisa com valores específicos de como a comparação deve ser feita.
</p>

<?php echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php echo CHtml::link('Gerar Relatório','#',array('class'=>'search-relatorio')); ?>
<div id="sub" class="search-form-relatorio" style="display:none">
<?php $this->renderPartial('_relatorio',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'agente-saude-executa-meta-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array(
                        'name'=>'Agente de Saude',
                        'value'=>'$data->agente_saude->servidor->nome',
                ),
                'meta.nome',
                array(
                        'name'=>'Valor da Meta',
                        'value'=>'$data->meta->valor',
                ),
                array(
                        'name'=>'Total de execu&ccedil;&otilde;es',
                        'value'=>'$data->total',
                ),
                array(
                        'name'=>'Status da Meta',
                        'value'=>'$data->isMetaBatida()',
                ),
                'competencia',
                array(
                        'class'=>'CButtonColumn',
                                                'template'=>'{view}',
                ),
        
	),
)); ?>
