<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Metas',
);

$this->menu=array(
	array('label'=>'Create enfermeiro_executa_meta', 'url'=>array('create')),
	array('label'=>'Manage enfermeiro_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Enfermeiro Executa Metas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
