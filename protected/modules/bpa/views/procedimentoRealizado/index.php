<?php
$this->breadcrumbs=array(
	'Procedimento Realizados',
);

$this->menu=array(
	array('label'=>'Create ProcedimentoRealizado', 'url'=>array('create')),
	array('label'=>'Manage ProcedimentoRealizado', 'url'=>array('admin')),
);
?>

<h1>Procedimento Realizados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
