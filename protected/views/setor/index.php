<?php
$this->breadcrumbs=array(
	'Setors',
);

$this->menu=array(
	array('label'=>'Create Setor', 'url'=>array('create')),
	array('label'=>'Manage Setor', 'url'=>array('admin')),
);
?>

<h1>Setors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
