<?php
$this->breadcrumbs=array(
	'Tecnico Enfermagem Executa Items'=>array('index'),
	$model->tecnico_enfermagem_cpf=>array('view','id'=>$model->tecnico_enfermagem_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List tecnico_enfermagem_executa_item', 'url'=>array('index')),
	array('label'=>'Create tecnico_enfermagem_executa_item', 'url'=>array('create')),
	array('label'=>'View tecnico_enfermagem_executa_item', 'url'=>array('view', 'id'=>$model->tecnico_enfermagem_cpf)),
	array('label'=>'Manage tecnico_enfermagem_executa_item', 'url'=>array('admin')),
);
?>

<h1>Update tecnico_enfermagem_executa_item <?php echo $model->tecnico_enfermagem_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>