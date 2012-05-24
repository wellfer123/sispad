
<?php $servidor = new Servidor();
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$servidor->searchAllNotSendReport(Date('Y'), Date('m')),
         'summaryText'=>'Servidores que ainda faltam ('.Date('m').'/'.Date('Y').')',
	'columns'=>array(
//                array(
//                    'name'=>'cpf',
//                    'value'=>'servidor.id',
//                ),
                'id',
		'nome',
	),
));

?>


