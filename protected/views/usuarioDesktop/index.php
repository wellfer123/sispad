<?php
$this->breadcrumbs=array(
	'Usuario Desktops',
);

$this->menu=array(
	array('label'=>'Create usuario_desktop', 'url'=>array('create')),
	array('label'=>'Manage usuario_desktop', 'url'=>array('admin')),
);
?>

<h1>Usuario Desktops</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
