<?php
/* @var $this ProfissionalVinculoController */
/* @var $model ProfissionalVinculo */

$this->breadcrumbs=array(
	'Vínculo Profissional'=>array('index'),
	'Gerenciamento',
);

    Yii::app()->clientScript->registerScript('active', "
jQuery('#profissional-vinculo-grid a.active').live('click',function() {
        if(!confirm('Você deseja realmente ativar esse profissional?')) return false;
        
        var th=this;
        var afterActive=function(){};
        $.fn.yiiGridView.update('profissional-vinculo-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('profissional-vinculo-grid');
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
jQuery('#profissional-vinculo-grid a.inactive').live('click',function() {
        if(!confirm('Você deseja realmente desativar esse profissional?')) return false;
        var th=this;
        var afterInactive=function(){};
        $.fn.yiiGridView.update('profissional-vinculo-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('profissional-vinculo-grid');
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
	$('#profissional-vinculo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profissional-vinculo-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
                array(
                    'filter'=>false,
                    'header'=>'Unidade',
                    'value'=>'$data->unidade->nome'
                ),
                array(
                    'filter'=>false,
                    'header'=>'Gestor',
                    'value'=>'$data->servidor->nome'
                ),
                array(
                    'filter'=>false,
                    'header'=>'Especialidade',
                    'value'=>'$data->profissao->nome'
                ),
                array(
                        'filter'=>false,
                        'header'=>'Situação',
                        'value'=>'$data->labelStatus()',
                ),
                array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                                'delete'=>array(
                                                'visible'=>'true',
                                                'url'=>'Yii::app()->createUrl("/profissionalVinculo/delete",array("unidade_cnes"=>$data->unidade_cnes,"cpf"=>$data->cpf,"codigo_profissao"=>$data->codigo_profissao))',
                                ),
                                'update'=>array(
                                                'visible'=>'false',
                                ),
                                'view'=>array(
                                                'url'=> '',
                                                'visible' => 'false',
                                ),
                        )
		),
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{active}{inactive}',
                        'buttons'=>array(
                                        'active'=>array(
                                                        'visible'=>'$data->ativo==ProfissionalVinculo::DESATIVO',
                                                        'label'=>'Ativar Profissional',
                                                        'url'=> 'Yii::app()->createUrl("/profissionalVinculo/active",array("unidade_cnes"=>$data->unidade_cnes,"cpf"=>$data->cpf,"codigo_profissao"=>$data->codigo_profissao))',
                                                        'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/unlocked.png',
                                                ),
                                        'inactive'=>array(
                                                        'visible'=>'$data->ativo==ProfissionalVinculo::ATIVO',
                                                        'url'=> 'Yii::app()->createUrl("/profissionalVinculo/inactive",array("unidade_cnes"=>$data->unidade_cnes,"cpf"=>$data->cpf,"codigo_profissao"=>$data->codigo_profissao))',
                                                        'label'=>'Desativar Profissional',
                                                        'options'=>array('class'=>'inactive','style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/locked.png',
                                                ),        
                        ),
		),
	),
)); ?>
