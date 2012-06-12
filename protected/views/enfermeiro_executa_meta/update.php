<?php
$this->breadcrumbs=array(
	'Enfermeiro Executa Metas'=>array('index'),
	$model->enfermeiro_cpf=>array('view','id'=>$model->enfermeiro_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List enfermeiro_executa_meta', 'url'=>array('index')),
	array('label'=>'Create enfermeiro_executa_meta', 'url'=>array('create')),
	array('label'=>'View enfermeiro_executa_meta', 'url'=>array('view', 'id'=>$model->enfermeiro_cpf)),
	array('label'=>'Manage enfermeiro_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Update enfermeiro_executa_meta <?php echo $model->enfermeiro_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>