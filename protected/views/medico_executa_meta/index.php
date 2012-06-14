<?php
$this->breadcrumbs=array(
	'Medico Executa Metas',
);

$this->menu=array(
	array('label'=>'Create medico_executa_meta', 'url'=>array('create')),
	array('label'=>'Manage medico_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Medico Executa Metas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
