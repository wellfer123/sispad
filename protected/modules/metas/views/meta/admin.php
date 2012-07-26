<?php

$this->breadcrumbs=array(
	'Meta'=>array('index'),
	'Manage',
);




?>

<h1>Metas</h1>

<?php

$indicadorId=$_GET['indicador_id'];
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'meta-grid',
	'dataProvider'=>$model->searchIndicadorId($indicadorId),
	'columns'=>array(
		'id',
                'nome',
                'valor',
                'percentagem',




		array(
			'class'=>'CButtonColumn',
		),
	),
));


?>
