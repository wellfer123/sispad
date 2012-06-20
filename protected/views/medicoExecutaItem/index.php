<?php
$this->breadcrumbs=array(
	'Medico Executa Items',
);

$this->menu=array(
	array('label'=>'Create medico_executa_item', 'url'=>array('create')),
	array('label'=>'Manage medico_executa_item', 'url'=>array('admin')),
);
?>

<h1>Medico Executa Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
