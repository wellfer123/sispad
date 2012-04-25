<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'item-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'nome',
	),
       
));

?>
