<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Metas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List enfermeiro_executa_meta', 'url'=>array('index')),
	array('label'=>'Manage enfermeiro_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Create enfermeiro_executa_meta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>