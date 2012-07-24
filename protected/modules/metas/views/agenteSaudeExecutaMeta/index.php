<?php
$this->breadcrumbs=array(
	'Agente Saude Executa Metas',
);

$this->menu=array(
	array('label'=>'Create agente_saude_executa_meta', 'url'=>array('create')),
	array('label'=>'Manage agente_saude_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Agente Saude Executa Metas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
