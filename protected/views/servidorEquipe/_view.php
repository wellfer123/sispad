<?php
    $codigo_area = $_GET['area'];
    $unidade_cnes = $_GET['cnes'];
   $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipe-grid',
	'dataProvider'=>$model->searchServidores($codigo_area,$unidade_cnes),
	'filter'=>$model,
	'columns'=>array(
		'servidor.nome',
                'servidor.cpf',
		
	),
));
?>