<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	$model->nome=>array('view','id'=>$model->id),
	'Atualização',
);

$this->menu=array(
	array('label'=>'Cadastro de Departamento', 'url'=>array('create')),
	array('label'=>'Visualizar Departamento', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gerenciamento de Departamentos', 'url'=>array('admin')),
);
?>

<h1>Atualização do Departamento <?php echo $model->nome; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>