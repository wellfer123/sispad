<?php
$this->breadcrumbs=array(
	'Total Relatorios',
);

$this->menu=array(
	array('label'=>'Create TotalRelatorio', 'url'=>array('create')),
	array('label'=>'Manage TotalRelatorio', 'url'=>array('admin')),
);
?>

<h1>Total Relatorios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
