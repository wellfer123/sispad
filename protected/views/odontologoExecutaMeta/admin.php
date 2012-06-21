<?php
$this->breadcrumbs=array(
	'Odontologo Executa Metas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Metas Executadas Por Odontologo', 'url'=>array('index')),
	array('label'=>'Enviar Nova Execução de Meta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('odontologo-executa-meta-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciamento Odontologo Executa Metas</h1>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'odontologo-executa-meta-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array(
                        'name'=>'Odontologo',
                        'value'=>'$data->odontologo->servidor->nome',
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
                array(
                        'class'=>'CButtonColumn',
                                                'template'=>'{view}',
                ),
        
	),
)); ?>