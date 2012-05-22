<?php
$this->breadcrumbs=array(
	'Titulo Eleitors',
);

$this->menu=array(
	array('label'=>'Create TituloEleitor', 'url'=>array('create')),
	array('label'=>'Manage TituloEleitor', 'url'=>array('admin')),
);
?>

<h1>Titulo Eleitors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
