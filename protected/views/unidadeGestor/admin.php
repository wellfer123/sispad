<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidade Gestor'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Cadastrar Unidade/Gestor', 'url'=>array('create')),
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

<?php echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unidade-gestor-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                    'name'=>'servidor',
                    'value'=>'$data->servidor->nome',
                ),
                array(
                    'name'=>'unidade',
                    'value'=>'$data->unidade->nome'
                ),
                array(
                        'header'=>'Ativo',
                        'value'=>'$data->labelStatus()',
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
