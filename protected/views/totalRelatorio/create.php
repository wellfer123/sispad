<?php
$this->breadcrumbs=array(
	'Total Relatorios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TotalRelatorio', 'url'=>array('index')),
	array('label'=>'Manage TotalRelatorio', 'url'=>array('admin')),
);
?>

<h1>Create TotalRelatorio</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>