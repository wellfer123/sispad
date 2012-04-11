<?php
Yii::import('application.services.FormataData');
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar relatórios', 'url'=>array('index')),
	array('label'=>'Enviar Relatório', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('relatorio-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciamento de Relatórios</h1>

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

<?php
 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'relatorio-grid',
	'dataProvider'=>$model->searchAll(),
	'columns'=>array(
		'id', 
		
		array(
                    'name'=>'Data Trabalho',
                    'value'=> 'FormataData::inverteData($data->data_trabalho,"-")',
                ),
		
                
                array(
                    'name'=>'Servidor',
                    'value'=>'$data->servidor->nome',
                ),
               
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
