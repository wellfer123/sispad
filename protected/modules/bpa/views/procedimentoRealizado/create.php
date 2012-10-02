<?php
$this->breadcrumbs=array(
	'Procedimento Realizados'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProcedimentoRealizado', 'url'=>array('index')),
	array('label'=>'Manage ProcedimentoRealizado', 'url'=>array('admin')),
);
?>

<h1>Create ProcedimentoRealizado</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>