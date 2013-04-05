<?php
/* @var $this UnidadeGestorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Unidade Gestors',
);

$this->menu=array(
	array('label'=>'Create UnidadeGestor', 'url'=>array('create')),
	array('label'=>'Manage UnidadeGestor', 'url'=>array('admin')),
);
?>

<h1>Unidade Gestors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
