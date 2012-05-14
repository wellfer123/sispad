<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Equipe', 'url'=>array('index')),
	array('label'=>'Create Equipe', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('equipe-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Equipes</h1>

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
	'id'=>'equipe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'codigo_segmento',
		'codigo_area',
		'tipo',
		'unidade_cnes',
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view}{update}{delete}',
                        'buttons'=>array(
                            'view'=>array(
                                'label'=>'visualizar',
                                'url'=>'Yii::app()->createUrl("/equipe/view",
                                        array("area"=>$data->codigo_area,"cnes"=>$data->unidade_cnes))',
                            ),
                            'update'=>array(
                                'label'=>'atualizar',
                                'url'=>'Yii::app()->createUrl("/equipe/update",
                                        array("area"=>$data->codigo_area,"cnes"=>$data->unidade_cnes))',
                            ),
                            'delete'=>array(
                                'label'=>'deletar equipe',
                                'url'=>'Yii::app()->createUrl("/equipe/delete",
                                        array("area"=>$data->codigo_area,"cnes"=>$data->unidade_cnes))',
                            ),
                              
                        ),
		),
	),
)); ?>
