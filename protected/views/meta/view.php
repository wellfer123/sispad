<?php

$this->breadcrumbs=array(
	'Meta'=>array('index'),
	'Manage',
);




?>

<h1>Metas</h1>

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
                array('class'=>'CButtonColumn',
                      'template'=>'{ver_itens}{adicionar_item}{adicionar_procedimento}',
                      'buttons'=>array(
                            'ver_itens'=>array(
                                'label'=>'Ver Itens',
                                'url'=>'Yii::app()->createUrl("/item/list",array("meta_id"=>$data->id))',
                                'imageUrl'=>  Yii::app()->request->baseUrl.'/images/view.png',
                            ),
                           'adicionar_item'=>array(

                                                        'label'=>'Adicionar Itens',
                                                        'url'=> 'Yii::app()->createUrl("/item/create",array("meta_id"=>$data->id))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add.png',
                                                ),
                          'adicionar_procedimento'=>array(

                                                        'label'=>'Adicionar Procedimentos',
                                                        'url'=> 'Yii::app()->createUrl("/metaProcedimento/add",array("meta_id"=>$data->id))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add2.png',
                                                ),
                      )  ),


	),
));


?>
                     


