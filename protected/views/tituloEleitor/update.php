<?php
$this->breadcrumbs=array(
	'Titulo Eleitors'=>array('index'),
	$model->servidor_cpf=>array('view','id'=>$model->servidor_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List TituloEleitor', 'url'=>array('index')),
	array('label'=>'Create TituloEleitor', 'url'=>array('create')),
	array('label'=>'View TituloEleitor', 'url'=>array('view', 'id'=>$model->servidor_cpf)),
	array('label'=>'Manage TituloEleitor', 'url'=>array('admin')),
);
?>

<h1>Update TituloEleitor <?php echo $model->servidor_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>