<?php
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List relatorio', 'url'=>array('index')),
	array('label'=>'Manage relatorio', 'url'=>array('admin')),
);
?>

<h1>Novo relatório</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>