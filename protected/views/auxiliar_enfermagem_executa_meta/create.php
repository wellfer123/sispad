<?php
$this->breadcrumbs=array(
	'Auxiliar Enfermagem Executa Metas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List auxiliar_enfermagem_executa_meta', 'url'=>array('index')),
	array('label'=>'Manage auxiliar_enfermagem_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Create auxiliar_enfermagem_executa_meta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>