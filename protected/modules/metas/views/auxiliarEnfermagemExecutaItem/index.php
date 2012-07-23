<?php
$this->breadcrumbs=array(
	'Auxiliar Enfermagem Executa Items',
);

$this->menu=array(
	array('label'=>'Create auxiliar_enfermagem_executa_item', 'url'=>array('create')),
	array('label'=>'Manage auxiliar_enfermagem_executa_item', 'url'=>array('admin')),
);
?>

<h1>Auxiliar Enfermagem Executa Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
