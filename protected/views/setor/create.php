<?php
$this->breadcrumbs=array(
	'Setores'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'Gerenciamento de Setores', 'url'=>array('admin')),
);
?>

<h1>Cadastro de Setor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>