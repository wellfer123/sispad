<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */

$this->breadcrumbs=array(
	'Produção Consolidada',
);

$this->menu=array(
	array('label'=>'Produção Consilidada', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('producao-consolidada-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="search-form" >
<?php $this->renderPartial('_searchConsolidada',array(
	'model'=>$model,
        'unidades'=>$unidades,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producao-consolidada-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                    'header'=>'Grupo',
                    'value'=>'$data->grupo',
                ),
                array(
                    'filter'=>false,
                    'header'=>'Total',
                    'value'=>'$data->total'
                ),
	),
)); ?>
