<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Equipe', 'url'=>array('index')),
	array('label'=>'Manage Equipe', 'url'=>array('admin')),
);
?>

<h1>Create Equipe</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>