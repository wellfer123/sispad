<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Criar Equipe', 'url'=>array('create')),
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

<h1>Administrar Equipes</h1>

<p>
Você pode opcionalmentre fazer a comparação com os operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) 
</p>

<?php echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
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
                        'template'=>'{view}{update}',
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
//                            'delete'=>array(
//                                'label'=>'deletar equipe',
//                                'url'=>'Yii::app()->createUrl("/equipe/delete",
//                                        array("area"=>$data->codigo_area,"cnes"=>$data->unidade_cnes))',
//                            ),
                              
                        ),
		),
	),
)); ?>
