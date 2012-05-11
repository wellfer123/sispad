<?php
   $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'codigo_segmento',
		'codigo_area',
		'tipo',
                array(
                    'name'=>'unidade',
                    'value'=>'$data->unidade->nome'
                ),
		
		'codigo_microarea',
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{adicionar_servidor}',
                        'buttons'=>array(
                                  'adicionar_servidor'=>array(
                                                        'label'=>'Adicionar Servidor',
                                                        'url'=>'Yii::app()->createUrl("/servidorEquipe/addToTeam",
                                                                array("area"=>$data->codigo_area,"cnes"=>$data->unidade_cnes))',
                                                        'imageUrl'=>  Yii::app()->request->baseUrl.'/images/add.png',
                                  ),
                        ),
		),
	),
));
?>