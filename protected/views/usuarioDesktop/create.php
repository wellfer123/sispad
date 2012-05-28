<?php
$this->breadcrumbs=array(
	'Usuario Desktops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List usuario_desktop', 'url'=>array('index')),
	array('label'=>'Manage usuario_desktop', 'url'=>array('admin')),
);
?>

<h1>Create usuario_desktop</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>