<?php
$this->breadcrumbs=array(
	'Usuários Desktop',
	'Gerenciamento',
);

$this->menu=array(
	array('label'=>'Cadastrar usuário desktop', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuario-desktop-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciamento de Usuários Desktop</h1>

<p>
Você pode opcionalmente entrar com um operador de comparação(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) iniciar cada uma de suas pesquisa com valores específicos de como a comparação deve ser feita.
</p>


<?php echo CHtml::link('Pesquisa avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-desktop-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                    'name'=>'Nome do usuario',
                    'value'=>'$data->servidor->nome',
                ),
		'token',
		'serial_aplicacao',
		array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                                    'delete'=>array(
                                            'visible'=>'false',
                                    ),
                                    'update'=>array(
                                            'url'=> 'Yii::app()->createUrl("/usuarioDesktop/update",array("serial"=>$data->serial_aplicacao,"id"=>$data->servidor_cpf))',
                                    ),
                                    'view'=>array(
                                            'url'=> 'Yii::app()->createUrl("/usuarioDesktop/view",array("serial"=>$data->serial_aplicacao,"id"=>$data->servidor_cpf))',
                                    )
                                    
                        )
		),
	),
)); ?>
