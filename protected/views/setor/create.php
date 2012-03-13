<?php
$this->breadcrumbs=array(
	'Setors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Setor', 'url'=>array('index')),
	array('label'=>'Manage Setor', 'url'=>array('admin')),
);
?>

<h1>Create Setor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>