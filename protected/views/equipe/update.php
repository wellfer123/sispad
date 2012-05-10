<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
	$model->codigo_area=>array('view','id'=>$model->codigo_area),
	'Update',
);

$this->menu=array(
	array('label'=>'List Equipe', 'url'=>array('index')),
	array('label'=>'Create Equipe', 'url'=>array('create')),
	array('label'=>'View Equipe', 'url'=>array('view', 'id'=>$model->codigo_area)),
	array('label'=>'Manage Equipe', 'url'=>array('admin')),
);
?>

<h1>Update Equipe <?php echo $model->codigo_area; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>