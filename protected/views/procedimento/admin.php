<?php
$this->breadcrumbs=array(
	'Procedimentos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Procedimento', 'url'=>array('index')),
	array('label'=>'Create Procedimento', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('procedimento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Procedimentos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'procedimento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'codigo',
		'nome',
		'tipo_complexidade',
		'tipo_sexo',
		'quantidade_maxima_execucao',
		'quantidade_dias_permanencia',
		/*
		'quantidade_pontos',
		'validade_idade_minima',
		'validade_idade_maxima',
		'validade_sh',
		'validade_sa',
		'validade_sp',
		'codigo_financiamento',
		'codigo_rubrica',
		'data_competencia',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
