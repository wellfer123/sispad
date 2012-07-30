<?php
$this->breadcrumbs=array(
	'Competencias'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Competências', 'url'=>array('index')),
	array('label'=>'Cadastrar Competência', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('competencia-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('active', "
jQuery('#competencia-grid a.active').live('click',function() {
        if(!confirm('Você deseja realmente ativar essa competência?')) return false;
        
        var th=this;
        var afterActive=function(){};
        $.fn.yiiGridView.update('competencia-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('competencia-grid');
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
jQuery('#competencia-grid a.inactive').live('click',function() {
        if(!confirm('Você deseja realmente desativar essa competência?')) return false;
        var th=this;
        var afterInactive=function(){};
        $.fn.yiiGridView.update('competencia-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('competencia-grid');
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

<h1>Gerenciar Competências</h1>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'competencia-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'mes_ano',
		array(
                    'name'=>'Status',
                    'value'=>'$data->labelStatus()',
                ),
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{active}{inactive}{view}',
                        'buttons'=>array(
                                       
                                        'active'=>array(
                                                        'visible'=>'$data->ativo==Competencia::FECHADA',
                                                        'label'=>'Abrir Competência',
                                                        'url'=> 'Yii::app()->createUrl("/competencia/active",array("id"=>$data->mes_ano))',
                                                        'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/unlocked.png',
                                                ),
                                        'inactive'=>array(
                                                        'visible'=>'$data->ativo==Competencia::ABERTA',
                                                        'url'=> 'Yii::app()->createUrl("/competencia/inactive",array("id"=>$data->mes_ano))',
                                                        'label'=>'Fechar Competência',
                                                        'options'=>array('class'=>'inactive','style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/locked.png',
                                                ),
                        ),
		),
	),
)); ?>
