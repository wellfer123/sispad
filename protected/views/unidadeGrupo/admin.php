<?php
/* @var $this UnidadeGrupoController */
/* @var $model UnidadeGrupo */

$this->breadcrumbs=array(
	'Unidade Grupo',
);

$this->menu=array(
	array('label'=>'Cadastrar Unidade/Grupo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#unidade-grupo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Unidade Grupo</h1>


<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unidade-grupo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
                array(
                    'header'=>'Unidade',
                    'value'=>'$data->unidade->nome'
                ),
                array(
                    'header'=>'Grupo',
                    'value'=>'$data->grupo->nome',
                ),
		array(
			'class'=>'CButtonColumn',
                         'template'=>'{update}{view}{delete}',
                         'buttons'=>array(
                                        'update'=>array(
                                                       'visible'=>'true',
                                                       'url'=> 'Yii::app()->createUrl("/unidadeGrupo/update",array("unidade_cnes"=>$data->unidade_cnes,"grupo_codigo"=>$data->grupo_codigo))',
                                                ),
                                        'view'=>array(
                                                        'visible'=>'true',
                                                        'url'=> 'Yii::app()->createUrl("/unidadeGrupo/view",array("unidade_cnes"=>$data->unidade_cnes,"grupo_codigo"=>$data->grupo_codigo))',
                                                ),  
                                        'delete'=>array(
                                                        'visible'=>'true',
                                                         'url'=> 'Yii::app()->createUrl("/unidadeGrupo/delete",array("unidade_cnes"=>$data->unidade_cnes,"grupo_codigo"=>$data->grupo_codigo))',
                                                ),
                                        
                        ),
		),
	),
)); ?>
