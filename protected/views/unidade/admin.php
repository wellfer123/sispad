<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	'Gerenciamento',
);

$this->menu=array(
	array('label'=>'Lista de Unidades', 'url'=>array('index')),
	array('label'=>'Cadastro de Unidade', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('unidade-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<p>
Você pode opcionalmente entrar com um operador de comparação(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) iniciar cada uma de suas pesquisa com valores específicos de como a comparação deve ser feita.
</p>

<?php echo CHtml::link('Pesquisa','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unidade-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'cnes',
		'nome',
                array(
                    'name'=>'regional',
                    'value'=>'$data->regional->regional_nome',
                ),
                array(
                    'name'=>'cidade',
                    'value'=>'$data->cidade->cidade_nome',
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
