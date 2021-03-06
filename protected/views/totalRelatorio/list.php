<?php
$this->breadcrumbs=array(
	'Total de Relatórios',
        'Meus relatórios enviados',
);


?>

<h1>Total de Relatórios</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'total-relatorio-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                array(
                    'name'=>'servidor',
                    'value'=>'$data->servidor->nome',
                ),
		'mes',
		'quantidade',
		'ano',
		'data_envio',
		array(
			'class'=>'CButtonColumn',
                        'viewButtonUrl'=>'Yii::app()->createUrl("TotalRelatorio/view", array("ano"=>$data->ano,"mes"=>$data->mes,"serv"=>$data->servidor_cpf  ))',
                        'buttons'=>array(
                                        'update'=>array(
                                                        'visible'=>'false',
                                                ),
                                        'view'=>array(
                                                        'visible'=>'true',
                                                ),
                                        'delete'=>array(
                                                        'visible'=>'false',
                                                ),
                        ),
		),
	),
));










?>
