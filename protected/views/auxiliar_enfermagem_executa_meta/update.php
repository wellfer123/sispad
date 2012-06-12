<?php
$this->breadcrumbs=array(
	'Auxiliar Enfermagem Executa Metas'=>array('index'),
	$model->auxiliar_enfermagem_cpf=>array('view','id'=>$model->auxiliar_enfermagem_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List auxiliar_enfermagem_executa_meta', 'url'=>array('index')),
	array('label'=>'Create auxiliar_enfermagem_executa_meta', 'url'=>array('create')),
	array('label'=>'View auxiliar_enfermagem_executa_meta', 'url'=>array('view', 'id'=>$model->auxiliar_enfermagem_cpf)),
	array('label'=>'Manage auxiliar_enfermagem_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Update auxiliar_enfermagem_executa_meta <?php echo $model->auxiliar_enfermagem_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>