<?php
$this->breadcrumbs=array(
	'Procedimento Realizados'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProcedimentoRealizado', 'url'=>array('index')),
	array('label'=>'Create ProcedimentoRealizado', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('procedimento-realizado-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Procedimento Realizados</h1>

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
	'id'=>'procedimento-realizado-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'unidade',
		'competencia',
		'profissional_cns',
		'profissional_cbo',
		'folha',
		'sequencia',
		/*
		'procedimento',
		'paciente_cns',
		'data_atendimento',
		'cid',
		'quantidade',
		'caracter_atendimento',
		'numero_autorizacao',
		'origem',
		'competencia_movimento',
		'servico',
		'equipe',
		'classificacao',
		'data_cadastro',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
