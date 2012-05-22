<?php
$this->breadcrumbs=array(
	'Procedimentos',
);

$this->menu=array(
	array('label'=>'Create Procedimento', 'url'=>array('create')),
	array('label'=>'Manage Procedimento', 'url'=>array('admin')),
);
?>

<h1>Procedimentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
