<?php
$this->breadcrumbs=array(
	'Enderecos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Endereco', 'url'=>array('index')),
	array('label'=>'Create Endereco', 'url'=>array('create')),
	array('label'=>'View Endereco', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Endereco', 'url'=>array('admin')),
);
?>

<h1>Update Endereco <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>