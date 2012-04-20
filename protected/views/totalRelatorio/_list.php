
<?php $servidor = new Servidor();
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$servidor->searchAllNotSendReport(Date('Y'), Date('m')),
	'columns'=>array(
		'cpf',
		'nome',
	),
));

?>


