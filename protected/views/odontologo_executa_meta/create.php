<?php
$this->breadcrumbs=array(
	'Odontologo Executa Metas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List odontologo_executa_meta', 'url'=>array('index')),
	array('label'=>'Manage odontologo_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Create odontologo_executa_meta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>