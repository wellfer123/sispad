<?php
$this->breadcrumbs=array(
	'Tecnico Enfermagem Executa Metas',
);

$this->menu=array(
	array('label'=>'Create tecnico_enfermagem_executa_meta', 'url'=>array('create')),
	array('label'=>'Manage tecnico_enfermagem_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Tecnico Enfermagem Executa Metas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
