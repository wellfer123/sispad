<?php
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



?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profissional-vinculo-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                array(
                    'header'=>'Profissional',
                    'value'=>'$data->servidor->nome',
                ),
                array(
                    'header'=>'Profisão',
                    'value'=>'$data->profissao->nome',
                ),
                array(
                        'header'=>'Situação',
                        'value'=>'$data->labelStatus()',
                ),
		
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{active}{inactive}',
                        'buttons'=>array(
                                        'update'=>array(
                                                        'visible'=>'false',
                                                ),
                                        'view'=>array(
                                                        'visible'=>'false',
                                                ),
                                        'delete'=>array(
                                                        'visible'=>'false',
                                                ),
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
));










?>
