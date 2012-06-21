<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Items',
);

$this->menu=array(
	array('label'=>'Create enfermeiro_executa_item', 'url'=>array('create')),
	array('label'=>'Manage enfermeiro_executa_item', 'url'=>array('admin')),
);
?>

<h1>Enfermeiro Executa Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
