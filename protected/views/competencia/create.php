<?php
$this->breadcrumbs=array(
	'Competencias'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar Competencias', 'url'=>array('index')),
	array('label'=>'Gerenciar Competencias', 'url'=>array('admin')),
);
?>

<h1>Create Competencia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>