

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profissional-vinculo-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                array(
                    'name'=>'servidor',
                    'value'=>'$data->servidor->nome',
                ),
                array(
                    'name'=>'Profissao',
                    'value'=>'$data->profissao->nome',
                ),
               
		
//		array(
//			'class'=>'CButtonColumn',
//                        'viewButtonUrl'=>'Yii::app()->createUrl("TotalRelatorio/view", array("ano"=>$data->ano,"mes"=>$data->mes,"serv"=>$data->servidor_cpf  ))',
//                        'buttons'=>array(
//                                        'update'=>array(
//                                                        'visible'=>'false',
//                                                ),
//                                        'view'=>array(
//                                                        'visible'=>'true',
//                                                ),
//                                        'delete'=>array(
//                                                        'visible'=>'false',
//                                                ),
//                        ),
//		),
	),
));










?>
