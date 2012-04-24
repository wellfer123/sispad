<?php
$this->breadcrumbs=array(
	'Indicador'=>array('index'),
	'Admin',
);

$this->menu=array(
	array('label'=>'Criar Indicador', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('indicador-grid', {
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
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indicador-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'nome',
                'descricao',
                'afericao',
                 array('name'=>'profissao',
                       'value'=>'$data->profissao->nome'),
                
                 array(
			'class'=>'CButtonColumn',
                        'template'=>'{adicionar_meta}{ver_metas}',
                        'buttons'=>array(

                                        'adicionar_meta'=>array(

                                                        'label'=>'Adicionar Meta',
                                                        'url'=> 'Yii::app()->createUrl("/meta/create",array("indicador_id"=>$data->id))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add.png',
                                                ),
                                        'ver_metas'=>array(

                                                        'label'=>'Ver Metas',
                                                        'url'=> 'Yii::app()->createUrl("/meta/view",array("indicador_id"=>$data->id))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/view.png',
                                                ),

                        ),
		),
	),
       

));

?>
