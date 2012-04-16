<?php
$this->breadcrumbs=array(
	'Dados Trabalhos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DadosTrabalho', 'url'=>array('index')),
	array('label'=>'Manage DadosTrabalho', 'url'=>array('admin')),
);
?>

<h1>Create DadosTrabalho</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>