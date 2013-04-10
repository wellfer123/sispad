<?php
/* @var $this UnidadeGrupoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Unidade Grupo',
);

$this->menu=array(
	array('label'=>'Cadastrar Unidade/Grupo', 'url'=>array('create')),
	array('label'=>'Gerenciar Unidade/Grupo', 'url'=>array('admin')),
);
?>

<h1>Unidade Grupo</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
