
<?php $servidor = new Servidor();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'total-relatorio-grid',
	'dataProvider'=>$servidor->search(),
	'columns'=>array(
               
		'nome',
		'cpf',
		
		array(
			'class'=>'CButtonColumn',
                         'template'=>'{active}{inactive}',
                       // 'viewButtonUrl'=>'Yii::app()->createUrl("TotalRelatorio/view", array("ano"=>$data->ano,"mes"=>$data->mes,"serv"=>$data->servidor_cpf  ))',
                         'buttons'=>array(
                                  
                                        'active'=>array(
                                                        'visible'=>'Servidor::existeEmTotalRelatorio($data->cpf)',
                                                        'label'=>'Ativar Usuário',
                                                       
                                                        'options'=>array('class'=>'active', 'style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/unlocked.png',
                                                ),
                                        'inactive'=>array(
                                                        'visible'=>'!Servidor::existeEmTotalRelatorio($data->cpf)',
                                                       
                                                        'label'=>'Desativar Usuário',
                                                        'options'=>array('class'=>'inactive','style'=>"padding-right:10px"),
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/locked.png',
                                                ),
                        ),
		),
	),
)); ?>


