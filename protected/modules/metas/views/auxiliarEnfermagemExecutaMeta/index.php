<?php
$this->breadcrumbs=array(
	'Auxiliar Enfermagem Executa Metas',
);

$this->menu=array(
	array('label'=>'Create auxiliar_enfermagem_executa_meta', 'url'=>array('create')),
	array('label'=>'Manage auxiliar_enfermagem_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Auxiliar Enfermagem Executa Metas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
