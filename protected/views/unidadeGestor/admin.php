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

  Yii::app()->clientScript->registerScript('active', "
jQuery('#unidade-gestor-grid a.active').live('click',function() {
        if(!confirm('Você deseja realmente ativar esse gestor?')) return false;
        
        var th=this;
        var afterActive=function(){};
        $.fn.yiiGridView.update('unidade-gestor-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('unidade-gestor-grid');
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
jQuery('#unidade-gestor-grid a.inactive').live('click',function() {
        if(!confirm('Você deseja realmente desativar esse gestor?')) return false;
        var th=this;
        var afterInactive=function(){};
        $.fn.yiiGridView.update('unidade-gestor-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('unidade-gestor-grid');
                        afterInactive(th,true,data);
                },
                error:function(XHR) {
                        return afterInactive(th,false,XHR);
                }
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
                         'template'=>'{update}{view}{delete}{active}{inactive}',
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
                                                        'visible'=>'true',
                                                         'url'=> 'Yii::app()->createUrl("/unidadeGestor/delete",array("unidade_cnes"=>$data->unidade_cnes,"servidor_cpf"=>$data->servidor_cpf))',
                                                ),
                                        'active'=>array(
                                                        'visible'=>'$data->ativo==UnidadeGestor::DESATIVO',
                                                        'label'=>'Ativar Gestor',
                                                        'url'=> 'Yii::app()->createUrl("/unidadeGestor/active",array("unidade_cnes"=>$data->unidade_cnes,"servidor_cpf"=>$data->servidor_cpf))',
                                                        'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/unlocked.png',
                                                ),
                                        'inactive'=>array(
                                                        'visible'=>'$data->ativo==UnidadeGestor::ATIVO',
                                                        'url'=> 'Yii::app()->createUrl("/unidadeGestor/inactive",array("unidade_cnes"=>$data->unidade_cnes,"servidor_cpf"=>$data->servidor_cpf))',
                                                        'label'=>'Desativar Gestor',
                                                        'options'=>array('class'=>'inactive','style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/locked.png',
                                                ),        
                        ),
		),
	),
)); ?>
