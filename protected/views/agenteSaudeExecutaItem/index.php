<?php
$this->breadcrumbs=array(
	'Agente Saude Executa Items',
);

$this->menu=array(
	array('label'=>'Create agente_saude_executa_item', 'url'=>array('create')),
	array('label'=>'Manage agente_saude_executa_item', 'url'=>array('admin')),
);
?>

<h1>Agente Saude Executa Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
