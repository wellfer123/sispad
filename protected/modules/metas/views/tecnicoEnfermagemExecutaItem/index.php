<?php
$this->breadcrumbs=array(
	'Tecnico Enfermagem Executa Items',
);

$this->menu=array(
	array('label'=>'Create tecnico_enfermagem_executa_item', 'url'=>array('create')),
	array('label'=>'Manage tecnico_enfermagem_executa_item', 'url'=>array('admin')),
);
?>

<h1>Tecnico Enfermagem Executa Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
