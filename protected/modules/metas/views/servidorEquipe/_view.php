<?php
    $codigo_area = $_GET['area'];
    $unidade_cnes = $_GET['cnes'];

   $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipe-grid',
	'dataProvider'=>$model->searchServidoresAtivos($codigo_area,$unidade_cnes),
       'summaryText'=>'Membros Ativos',
	//'filter'=>$model,
	'columns'=>array(
		'nome',
                'cpf',
                'funcao',
		
	),
));
?>