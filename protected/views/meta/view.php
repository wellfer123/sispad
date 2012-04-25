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
                      'template'=>'{ver_itens}',
                      'buttons'=>array(
                            'ver_itens'=>array(
                                'label'=>'Ver Itens',
                                'url'=>'Yii::app()->createUrl("/item/list",array("meta_id"=>$data->id))',
                                'imageUrl'=>  Yii::app()->request->baseUrl.'/images/view.png',
                            )
                      )  ),


	),
));


?>
                     


