<?php
$this->breadcrumbs=array(
	'Faltas',
);

$this->menu=array(
	array('label'=>'Create falta', 'url'=>array('create')),
	array('label'=>'Manage falta', 'url'=>array('admin')),
);
?>

<h1>Faltas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
