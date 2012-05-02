<?php
$this->breadcrumbs=array(
	'Faltas'=>array('index'),
	'Prepared Create',
);

$this->menu=array(
	array('label'=>'List falta', 'url'=>array('index')),
	array('label'=>'Manage falta', 'url'=>array('admin')),
);
?>

<h1>Faltas</h1>

<?php echo $this->renderPartial('_form_prepared', array('model'=>$model)); ?>