<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'item-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'nome',
                'descricao',
                'status',
                'afericao',
                'profissao_codigo',
                 array(
			'class'=>'CButtonColumn',
                        'template'=>'{adicionar_meta}{ver_metas}',
                        'buttons'=>array(

                                        'adicionar_meta'=>array(

                                                        'label'=>'Adicionar Meta',
                                                        'url'=> 'Yii::app()->createUrl("/meta/create",array("indicador_id"=>$data->id))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add.png',
                                                ),
                                        'ver_metas'=>array(

                                                        'label'=>'Ver Metas',
                                                        'url'=> 'Yii::app()->createUrl("/meta/admin",array("indicador_id"=>$data->id))',
                                                        //'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/view.png',
                                                ),

                        ),
		),
	),
       

));

?>
