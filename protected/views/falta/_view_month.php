<?php
         $mes = $_GET['mes'];
         $ano = $_GET['ano'];
         $unidade_cnes = $_GET['unidade'];
$totalFalta = new TotalFalta;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'falta-grid',
	'dataProvider'=>$totalFalta->searchMensalPorUnidade($mes,$ano,$unidade_cnes),
	'columns'=>array(
		'nome',
                'quantidade',
//                array(
//                    'name'=>'total',
//                    'value'=>'$data->quantidade'
//                ),
               
	),

));

?>
