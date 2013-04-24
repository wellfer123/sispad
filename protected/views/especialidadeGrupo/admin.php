<?php
/* @var $this EspecialidadeGrupoController */
/* @var $model EspecialidadeGrupo */

$this->breadcrumbs=array(
	'Especialidade Grupo',
);

$this->menu=array(
	array('label'=>'Cadastrar Especialidade/Grupo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#especialidade-grupo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Especialidade Grupo</h1>


<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'especialidade-grupo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
                array(
                    'header'=>'Especialidade',
                    'value'=>'$data->especialidade->nome'
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
                                                       'url'=> 'Yii::app()->createUrl("/especialidadeGrupo/update",array("profissao_codigo"=>$data->profissao_codigo,"grupo_codigo"=>$data->grupo_codigo))',
                                                ),
                                        'view'=>array(
                                                        'visible'=>'true',
                                                        'url'=> 'Yii::app()->createUrl("/especialidadeGrupo/view",array("profissao_codigo"=>$data->profissao_codigo,"grupo_codigo"=>$data->grupo_codigo))',
                                                ),  
                                        'delete'=>array(
                                                        'visible'=>'true',
                                                         'url'=> 'Yii::app()->createUrl("/especialidadeGrupo/delete",array("profissao_codigo"=>$data->profissao_codigo,"grupo_codigo"=>$data->grupo_codigo))',
                                                ),
                                        
                        ),
		),
	),
)); ?>
