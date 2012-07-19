<?php

$indicadorId=$_GET['indicador_id'];
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'meta-grid',
	'dataProvider'=>$model->searchIndicadorId($indicadorId),
	'columns'=>array(
		'id',
                'nome',
               
                 array(
                        'name'=>'Tipo',
                        'value'=>'$data->exibeNomeTipo()',
                 ),
                 array('name'=>'periodicidade',
                      'value'=>'$data->periodicidade->nome',),
                'valor',
                'percentagem',
                 array(
			'class'=>'CButtonColumn',
                        'template'=>'{ver_meta}{ver_itens}{ver_procedimento}{adicionar_item}{adicionar_procedimento}',
                        'buttons'=>array(
                                            'ver_meta'=>array(
                                            'label'=>'Ver Meta',
                                            'url'=>'Yii::app()->createUrl("/meta/details",array("id"=>$data->id,"indicador_id"=>$_GET["indicador_id"]))',
                                            'imageUrl'=>  Yii::app()->request->baseUrl.'/images/view.png',
                                            ),
                                            'ver_itens'=>array(
                                            'visible'=>'$data->tipo==Meta::ITENS',
                                            'label'=>'Ver Itens',
                                            'url'=>'Yii::app()->createUrl("/item/list",array("meta_id"=>$data->id,"indicador_id"=>$_GET["indicador_id"]))',
                                            'imageUrl'=>  Yii::app()->request->baseUrl.'/images/view2.png',
                                        ),
                                            'ver_procedimento'=>array(
                                            'visible'=>'$data->tipo==Meta::PROCEDIMENTO',
                                            'label'=>'Ver Procedimento',
                                            'url'=>'Yii::app()->createUrl("/metaProcedimento/view",array("meta_id"=>$data->id,"indicador_id"=>$_GET["indicador_id"]))',
                                            'imageUrl'=>  Yii::app()->request->baseUrl.'/images/view2.png',
                                        ),

                                        'adicionar_item'=>array(
                                                        'visible'=>'$data->tipo==Meta::ITENS',
                                                        'label'=>'Adicionar Itens',
                                                        'url'=> 'Yii::app()->createUrl("/item/create",array("meta_id"=>$data->id,"indicador_id"=>$_GET["indicador_id"]))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add.png',
                                                ),
                                        'adicionar_procedimento'=>array(
                                                        'visible'=>'$data->tipo==Meta::PROCEDIMENTO',
                                                        'label'=>'Adicionar Procedimentos',
                                                        'url'=> 'Yii::app()->createUrl("/metaProcedimento/add",array("meta_id"=>$data->id,"indicador_id"=>$_GET["indicador_id"]))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add2.png',
                                                ),



                        ),
		),
	),
       
));


?>
