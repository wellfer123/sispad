<?php
$this->breadcrumbs=array(
	'Competencias',
);

$this->menu=array(
	array('label'=>'Criar Competencia', 'url'=>array('create')),
	array('label'=>'Administrar Competencias', 'url'=>array('admin')),
);
?>

<h1>Competencias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
