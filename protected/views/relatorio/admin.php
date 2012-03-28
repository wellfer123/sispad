<?php Yii::import('application.services.FormataData');//include 'protected/services/FormataData.php'?>
<?php
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List relatorio', 'url'=>array('index')),
	array('label'=>'Create relatorio', 'url'=>array('create')),
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

<h1>Manage Relatorios</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
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
		'servidor_cpf',
                array(
                    'name'=>'Servidor',
                    'value'=>"2",
                ),
               
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
