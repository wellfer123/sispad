<?php
$this->breadcrumbs=array(
	'Equipes',
);

$this->menu=array(
	array('label'=>'Create Equipe', 'url'=>array('create')),
	array('label'=>'Manage Equipe', 'url'=>array('admin')),
);
?>

<h1>Equipes</h1>

<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>

