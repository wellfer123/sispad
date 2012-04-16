<?php
$this->breadcrumbs=array(
	'Identidades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Identidade', 'url'=>array('index')),
	array('label'=>'Manage Identidade', 'url'=>array('admin')),
);
?>

<h1>Create Identidade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>