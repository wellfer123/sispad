<?php
$this->breadcrumbs=array(
	'Tecnico Enfermagem Executa Metas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List tecnico_enfermagem_executa_meta', 'url'=>array('index')),
	array('label'=>'Manage tecnico_enfermagem_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Create tecnico_enfermagem_executa_meta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>