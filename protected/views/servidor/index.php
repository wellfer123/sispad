<?php
$this->breadcrumbs=array(
	'Servidors',
);

$this->menu=array(
	array('label'=>'Create Servidor', 'url'=>array('create')),
	array('label'=>'Manage Servidor', 'url'=>array('admin')),
);
?>

<h1>Servidors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
