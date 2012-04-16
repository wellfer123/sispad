<?php
$this->breadcrumbs=array(
	'Titulo Eleitors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TituloEleitor', 'url'=>array('index')),
	array('label'=>'Manage TituloEleitor', 'url'=>array('admin')),
);
?>

<h1>Create TituloEleitor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>