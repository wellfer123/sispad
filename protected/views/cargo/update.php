<?php
$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Cargos', 'url'=>array('index')),
	array('label'=>'Criar Cargo', 'url'=>array('create')),
	array('label'=>'Ver Cargo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Cargos', 'url'=>array('admin')),
);
?>

<h1>Update Cargo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>