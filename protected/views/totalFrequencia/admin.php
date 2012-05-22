<?php
$this->breadcrumbs=array(
	'Frequencias'=>array('index'),
	'Gerenciamento',
);

$this->menu=array(
	array('label'=>'Lançar Frequência', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('total-frequencia-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciamento de Frequências</h1>

<p>
Você pode opcionalmente entrar com um operador de comparação(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) iniciar cada uma de suas pesquisa com valores específicos de como a comparação deve ser feita.
</p>

<?php echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'total-frequencia-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                    'name'=>'servidor',
                    'value'=>'$data->servidor->nome',
                ),
		'mes',
		'quantidade',
		'ano',
		'data_envio',
		array(
			'class'=>'CButtonColumn',
                        'viewButtonUrl'=>'Yii::app()->createUrl("TotalFrequencia/view", array("ano"=>$data->ano,"mes"=>$data->mes,"serv"=>$data->servidor_cpf  ))',
                        'buttons'=>array(
                                        'update'=>array(
                                                        'visible'=>'false',
                                                ),
                                        'view'=>array(
                                                        'visible'=>'true',
                                                ),
                                        'delete'=>array(
                                                        'visible'=>'false',
                                                ),
                        ),
		),
	),
)); ?>
