<?php
if(isset($_GET['meta_id']))
         $metaId = $_GET['meta_id'];
else
    $metaId = null;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'item-grid',
	'dataProvider'=>$model->searchMetaId($metaId),
	'columns'=>array(
		'id',
		'nome',
	),
       
));

?>
