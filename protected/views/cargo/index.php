<?php
$this->breadcrumbs=array(
	'Cargos',
);

$this->menu=array(
	array('label'=>'Criar Cargo', 'url'=>array('create')),
	array('label'=>'Administrar Cargos', 'url'=>array('admin')),
);
?>

<h1>Cargos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
