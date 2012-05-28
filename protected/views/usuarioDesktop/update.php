<?php
$this->breadcrumbs=array(
	'Usuario Desktops'=>array('index'),
	$model->servidor_cpf=>array('view','id'=>$model->servidor_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List usuario_desktop', 'url'=>array('index')),
	array('label'=>'Create usuario_desktop', 'url'=>array('create')),
	array('label'=>'View usuario_desktop', 'url'=>array('view', 'id'=>$model->servidor_cpf)),
	array('label'=>'Manage usuario_desktop', 'url'=>array('admin')),
);
?>

<h1>Update usuario_desktop <?php echo $model->servidor_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>