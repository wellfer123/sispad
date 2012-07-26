<?php
$this->breadcrumbs=array(
	'Procedimentos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Procedimento', 'url'=>array('index')),
	array('label'=>'Manage Procedimento', 'url'=>array('admin')),
);
?>

<h1>Create Procedimento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>