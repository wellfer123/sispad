<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidade Gestors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UnidadeGestor', 'url'=>array('index')),
	array('label'=>'Create UnidadeGestor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#unidade-gestor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Unidade Gestors</h1>

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
	'id'=>'unidade-gestor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                    'name'=>'servidor',
                    'value'=>'$data->servidor->nome'
                ),
                array(
                    'name'=>'unidade',
                    'value'=>'$data->unidade->nome'
                ),
		array(
			'class'=>'CButtonColumn',
                         'buttons'=>array(
                                        'update'=>array(
                                                       'visible'=>'true',
                                                       'url'=> 'Yii::app()->createUrl("/unidadeGestor/update",array("unidade_cnes"=>$data->unidade_cnes,"servidor_cpf"=>$data->servidor_cpf))',
                                                ),
                                        'view'=>array(
                                                        'visible'=>'true',
                                                        'url'=> 'Yii::app()->createUrl("/unidadeGestor/view",array("unidade_cnes"=>$data->unidade_cnes,"servidor_cpf"=>$data->servidor_cpf))',
                                                ),  
                                        'delete'=>array(
                                                        'visible'=>'false',
                                                ),
                        ),
		),
	),
)); ?>
