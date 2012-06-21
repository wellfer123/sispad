<?php
$this->breadcrumbs=array(
	'Odontologo Executa Items',
);

$this->menu=array(
	array('label'=>'Create odontologo_executa_item', 'url'=>array('create')),
	array('label'=>'Manage odontologo_executa_item', 'url'=>array('admin')),
);
?>

<h1>Odontologo Executa Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
