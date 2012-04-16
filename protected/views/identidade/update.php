<?php
$this->breadcrumbs=array(
	'Identidades'=>array('index'),
	$model->servidor_cpf=>array('view','id'=>$model->servidor_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List Identidade', 'url'=>array('index')),
	array('label'=>'Create Identidade', 'url'=>array('create')),
	array('label'=>'View Identidade', 'url'=>array('view', 'id'=>$model->servidor_cpf)),
	array('label'=>'Manage Identidade', 'url'=>array('admin')),
);
?>

<h1>Update Identidade <?php echo $model->servidor_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>