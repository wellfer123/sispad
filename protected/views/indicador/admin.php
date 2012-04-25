<?php
$this->breadcrumbs=array(
	'Indicador'=>array('index'),
	'Admin',
);

$this->menu=array(
	array('label'=>'Criar Indicador', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('active', "
jQuery('#indicador-grid a.active').live('click',function() {
        if(!confirm('Você deseja realmente ativar esse indicador?')) return false;

        var th=this;
        var afterActive=function(){};
        $.fn.yiiGridView.update('indicador-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('indicador-grid');
                        afterActive(th,true,data);
                },
                error:function(XHR) {
                        return afterActive(th,false,XHR);
                }
        });
        return false;
});
");

Yii::app()->clientScript->registerScript('inactive', "
jQuery('#indicador-grid a.inactive').live('click',function() {
        if(!confirm('Você deseja realmente desativar esse indicador?')) return false;
        var th=this;
        var afterInactive=function(){};
        $.fn.yiiGridView.update('indicador-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('indicador-grid');
                        afterInactive(th,true,data);
                },
                error:function(XHR) {
                        return afterInactive(th,false,XHR);
                }
        });
        return false;
});
");
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
                        'template'=>'{active}{inactive}{adicionar_meta}{ver_metas}',
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
                                          'active'=>array(
                                                        'visible'=>'$data->status==Indicador::DESATIVO',
                                                        'label'=>'Ativar Indicador',
                                                        'url'=> 'Yii::app()->createUrl("/indicador/active",array("id"=>$data->id))',
                                                        'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/unlocked.png',
                                                ),
                                        'inactive'=>array(
                                                        'visible'=>'$data->status==Indicador::ATIVO',
                                                        'url'=> 'Yii::app()->createUrl("/indicador/inactive",array("id"=>$data->id))',
                                                        'label'=>'Desativar Indicador',
                                                        'options'=>array('class'=>'inactive','style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/locked.png',
                                                ),

                        ),
		),
	),
       

));

?>
