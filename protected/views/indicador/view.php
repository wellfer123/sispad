<?php
$this->breadcrumbs=array(
	'Indicador'=>array('index'),
	'Ver',
);


?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indicador-grid',
	'dataProvider'=>$model->searchPorProfissao($profissaoCodigo),
	'columns'=>array(
		'id',
		'nome',
                'descricao',
                'afericao',
                 array('name'=>'profissao',
                       'value'=>'$data->profissao->nome'),

                 array(
			'class'=>'CButtonColumn',
                        'template'=>'{ver_metas}',
                        'buttons'=>array(
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
