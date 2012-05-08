<?php
         $mes = $_GET['mes'];
         $ano = $_GET['ano'];
$totalFalta = new TotalFalta;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'falta-grid',
	'dataProvider'=>$totalFalta->searchMensal($mes,$ano),
	'columns'=>array(
		'servidor.nome',
                array(
                    'name'=>'total',
                    'value'=>'$data->quantidade'
                ),
               
	),

));

?>
