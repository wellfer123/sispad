<?php
$this->breadcrumbs=array(
	'Servidors'=>array('index'),
	$model->cpf=>array('view','id'=>$model->cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List Servidor', 'url'=>array('index')),
	array('label'=>'Create Servidor', 'url'=>array('create')),
	array('label'=>'View Servidor', 'url'=>array('view', 'id'=>$model->cpf)),
	array('label'=>'Manage Servidor', 'url'=>array('admin')),
);
?>

<h1>Update Servidor <?php echo $model->cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>