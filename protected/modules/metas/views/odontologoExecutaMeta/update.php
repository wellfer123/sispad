<?php
$this->breadcrumbs=array(
	'Odontologo Executa Metas'=>array('index'),
	$model->odontologo_cpf=>array('view','id'=>$model->odontologo_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List odontologo_executa_meta', 'url'=>array('index')),
	array('label'=>'Create odontologo_executa_meta', 'url'=>array('create')),
	array('label'=>'View odontologo_executa_meta', 'url'=>array('view', 'id'=>$model->odontologo_cpf)),
	array('label'=>'Manage odontologo_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Update odontologo_executa_meta <?php echo $model->odontologo_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>