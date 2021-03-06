<?php
$this->breadcrumbs=array(
        'Metas'=>array('Meta/admin'),
	'Executadas por Enfermeiro'=>array('admin'),
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
        $.fn.yiiGridView.update('enfermeiro-executa-meta-grid', {
    data: $(this).serialize()
    });
    return false;
    });
    ");
?>

<h1>Gerenciamento de Metas Executadas por Enfermeiro</h1>

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
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'enfermeiro-executa-meta-grid',
'dataProvider'=>$model->search(),
'columns'=>array(
                array(
                        'name'=>'Enfermeiro',
                        'value'=>'$data->enfermeiro->servidor->nome',
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