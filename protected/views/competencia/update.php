<?php
$this->breadcrumbs=array(
	'Competencias'=>array('index'),
	$model->mes_ano=>array('view','id'=>$model->mes_ano),
	'Update',
);

$this->menu=array(
	array('label'=>'List Competencia', 'url'=>array('index')),
	array('label'=>'Create Competencia', 'url'=>array('create')),
	array('label'=>'View Competencia', 'url'=>array('view', 'id'=>$model->mes_ano)),
	array('label'=>'Manage Competencia', 'url'=>array('admin')),
);
?>

<h1>Update Competencia <?php echo $model->mes_ano; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>