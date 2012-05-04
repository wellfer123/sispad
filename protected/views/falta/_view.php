<?php
         $servidorCpf = $_GET['cpf'];
         $mes = $_GET['mes'];
         $ano = $_GET['ano'];

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'falta-grid',
	'dataProvider'=>$model->searchPorServidor($servidorCpf,$mes,$ano),
	'columns'=>array(
		'dia',
                'obs_motivo',
                array(
                    'name'=>'motivo',
                    'value'=>'$data->motivo->descricao'
                ),
	),

));

?>
