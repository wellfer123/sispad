<?php
$this->breadcrumbs=array(
	'Setores'=>array('index'),
	'Gerenciamento',
);

$this->menu=array(
	array('label'=>'Cadastro de Setor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('setor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciamento de Setores</h1>

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
	'id'=>'setor-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'nome',
		'descricao',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
