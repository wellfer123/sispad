<?php
$this->breadcrumbs=array(
	'Servidors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Servidor', 'url'=>array('index')),
	array('label'=>'Manage Servidor', 'url'=>array('admin')),
);
?>

<h1>Create Servidor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>