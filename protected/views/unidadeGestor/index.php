<?php
/* @var $this UnidadeGestorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Unidade Gestor',
);

$this->menu=array(
	array('label'=>'Cadastrar UnidadeGestor', 'url'=>array('create')),
	array('label'=>'Gerenciar UnidadeGestor', 'url'=>array('admin')),
);
?>

<h1>Unidade Gestor</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
