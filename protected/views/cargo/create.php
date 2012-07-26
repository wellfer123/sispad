<?php
$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar Cargos', 'url'=>array('index')),
	array('label'=>'Administrar Cargos', 'url'=>array('admin')),
);
?>

<h1>Create Cargo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>