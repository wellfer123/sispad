<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Metas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List enfermeiro_executa_meta', 'url'=>array('index')),
	array('label'=>'Create enfermeiro_executa_meta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
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

<h1>Manage Enfermeiro Executa Metas</h1>

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
	'id'=>'enfermeiro-executa-meta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'enfermeiro_cpf',
		'unidade_cnes',
		'meta_id',
		'total',
		'data_inicio',
		'data_fim',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
