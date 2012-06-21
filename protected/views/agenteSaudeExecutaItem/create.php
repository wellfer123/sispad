<?php
$this->breadcrumbs=array(
	'Agente Saude Executa Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List agente_saude_executa_item', 'url'=>array('index')),
	array('label'=>'Manage agente_saude_executa_item', 'url'=>array('admin')),
);
?>

<h1>Create agente_saude_executa_item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>