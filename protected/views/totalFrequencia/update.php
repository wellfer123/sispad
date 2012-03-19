<?php
$this->breadcrumbs=array(
	'Total Frequencias'=>array('index'),
	$model->ano=>array('view','id'=>$model->ano),
	'Update',
);

$this->menu=array(
	array('label'=>'List TotalFrequencia', 'url'=>array('index')),
	array('label'=>'Create TotalFrequencia', 'url'=>array('create')),
	array('label'=>'View TotalFrequencia', 'url'=>array('view', 'id'=>$model->ano)),
	array('label'=>'Manage TotalFrequencia', 'url'=>array('admin')),
);
?>

<h1>Update TotalFrequencia <?php echo $model->ano; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>