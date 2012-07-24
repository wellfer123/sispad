<?php
$this->breadcrumbs=array(
	'Competencias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Competencia', 'url'=>array('index')),
	array('label'=>'Manage Competencia', 'url'=>array('admin')),
);
?>

<h1>Create Competencia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>