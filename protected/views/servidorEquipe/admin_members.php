<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	'Gerenciamento Membros',
);

$this->menu=array(
	array('label'=>'Adicionar Membros', 'url'=>array('servidorEquipe/addToTeam',"area"=>$model->equipe_codigo_area,
                                                            "cnes"=>$model->equipe_unidade_cnes)),
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
jQuery('#servidorEquipe-grid a.active').live('click',function() {
        if(!confirm('Você deseja realmente ativar esse usuário?')) return false;

        var th=this;
        var afterActive=function(){};
        $.fn.yiiGridView.update('servidorEquipe-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('servidorEquipe-grid');
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
jQuery('#servidorEquipe-grid a.inactive').live('click',function() {
        if(!confirm('Você deseja realmente desativar esse usuário?')) return false;
        var th=this;
        var afterInactive=function(){};
        $.fn.yiiGridView.update('servidorEquipe-grid', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                        $.fn.yiiGridView.update('servidorEquipe-grid');
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

<h1>Gerenciamento de Membros</h1>

 <?php echo $this->renderMessages(); ?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servidorEquipe-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'servidor.nome',
		'servidor.cpf',
                'funcao',
                array(
                        'name'=>'ativo',
                        'value'=>'$data->labelStatus()',
                ),
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{active}{inactive}',
                        'buttons'=>array(
                                        'active'=>array(
                                                        'visible'=>'$data->ativo==ServidorEquipe::DESATIVO',
                                                        'label'=>'Ativar Usuário',
                                                        'url'=> 'Yii::app()->createUrl("/servidorEquipe/active",array( "codigo_area"=>$data->equipe_codigo_area,
                                                            "unidade_cnes"=>$data->equipe_unidade_cnes,"servidor_cpf"=>$data->servidor_cpf))',
                                                        'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/unlocked.png',
                                                ),
                                        'inactive'=>array(
                                                        'visible'=>'$data->ativo==ServidorEquipe::ATIVO',
                                                        'url'=> 'Yii::app()->createUrl("/servidorEquipe/inactive",array( "codigo_area"=>$data->equipe_codigo_area,
                                                            "unidade_cnes"=>$data->equipe_unidade_cnes,"servidor_cpf"=>$data->servidor_cpf))',
                                                        'label'=>'Desativar Usuário',
                                                        'options'=>array('class'=>'inactive','style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/locked.png',
                                                ),
                        ),
		),
	),
)); ?>
