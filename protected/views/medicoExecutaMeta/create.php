<?php
$this->breadcrumbs=array(
	'Medico Executa Metas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List medico_executa_meta', 'url'=>array('index')),
	array('label'=>'Manage medico_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Create medico_executa_meta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>