<?php

$indicadorId=$_GET['indicador_id'];
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'meta-grid',
	'dataProvider'=>$model->searchIndicadorId($indicadorId),
	'columns'=>array(
		'id',
                'nome',
                'valor',
                 array('name'=>'periodicidade',
                      'value'=>'$data->periodicidade->nome',),
                'percentagem',
                 array(
			'class'=>'CButtonColumn',
                        'template'=>'{adicionar_item}{adicionar_procedimento}',
                        'buttons'=>array(

                                        'adicionar_item'=>array(
                                                        'visible'=>'$data->tipo==Meta::ITENS',
                                                        'label'=>'Adicionar Itens',
                                                        'url'=> 'Yii::app()->createUrl("/item/create",array("meta_id"=>$data->id))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add.png',
                                                ),
                                        'adicionar_procedimento'=>array(
                                                        'visible'=>'$data->tipo==Meta::PROCEDIMENTO',
                                                        'label'=>'Adicionar Procedimentos',
                                                        'url'=> 'Yii::app()->createUrl("/metaProcedimento/add",array("meta_id"=>$data->id))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add2.png',
                                                ),



                        ),
		),
	),
       
));


?>
