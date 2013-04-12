<?php
$this->breadcrumbs=array(
	'Usuários'=>array('index'),
	'Gerenciamento',
);

$this->menu=array(
	array('label'=>'Registrar Usuário', 'url'=>array('register')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('active', "
jQuery('#user-grid a.active').live('click',function() {
        if(!confirm('Você deseja realmente ativar esse usuário?')) return false;
        
        var th=this;
        var afterActive=function(){};
        $.fn.yiiGridView.update('user-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('user-grid');
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
jQuery('#user-grid a.inactive').live('click',function() {
        if(!confirm('Você deseja realmente desativar esse usuário?')) return false;
        var th=this;
        var afterInactive=function(){};
        $.fn.yiiGridView.update('user-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('user-grid');
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

<h1>Gerenciamento de Usuários</h1>

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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                    'header'=>'Nome do Usuário',
                    'value'=>'$data->username',
                ),
		array(
                    'header'=>'E-mail',
                    'value'=>'$data->email',
                ),
                array(
                        'name'=>'ativo',
                        'value'=>'$data->labelStatus()',
                ),
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{active}{inactive}{view}',
                        'buttons'=>array(
                                        'view'=>array(
                                                        'visible'=>'true',
                                                        'label'=>'Ver usuário',
                                                        'url'=> 'Yii::app()->createUrl("/user/view",array("id"=>$data->id))',
                                                        'options'=>array('style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/view.png',
                                                ),
                                        'active'=>array(
                                                        'visible'=>'$data->ativo==User::DESATIVO',
                                                        'label'=>'Ativar Usuário',
                                                        'url'=> 'Yii::app()->createUrl("/user/active",array("id"=>$data->id))',
                                                        'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/unlocked.png',
                                                ),
                                        'inactive'=>array(
                                                        'visible'=>'$data->ativo==User::ATIVO',
                                                        'url'=> 'Yii::app()->createUrl("/user/inactive",array("id"=>$data->id))',
                                                        'label'=>'Desativar Usuário',
                                                        'options'=>array('class'=>'inactive','style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/locked.png',
                                                ),
                        ),
		),
	),
)); ?>
