

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unidade-gestor-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                array(
                    'name'=>'Unidade',
                    'value'=>'$data->unidade->nome',
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
