<?php
$this->breadcrumbs=array(
	'Identidades',
);

$this->menu=array(
	array('label'=>'Create Identidade', 'url'=>array('create')),
	array('label'=>'Manage Identidade', 'url'=>array('admin')),
);
?>

<h1>Identidades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
