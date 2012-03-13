<?php
$this->breadcrumbs=array(
	'Relatorios',
);

$this->menu=array(
	array('label'=>'Create relatorio', 'url'=>array('create')),
	array('label'=>'Manage relatorio', 'url'=>array('admin')),
);
?>

<h1>Relatorios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
