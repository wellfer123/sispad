<?php
/* @var $this EspecialidadeGrupoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Especialidade Grupo',
);

$this->menu=array(
	array('label'=>'Cadastrar Especialidade/Grupo', 'url'=>array('create')),
	array('label'=>'Gerenciar Especialidade/Grupo', 'url'=>array('admin')),
);
?>

<h1>Especialidade Grupo</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
