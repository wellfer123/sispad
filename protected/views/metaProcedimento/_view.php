<?php
if(isset($_GET['meta_id']))
         $metaId = $_GET['meta_id'];
else
    $metaId = null;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'metaProcedimento-grid',
	'dataProvider'=>$model->searchMetaId($metaId),
	'columns'=>array(
                'procedimento.codigo',
		'procedimento.nome'
		
	),
       
));

?>
