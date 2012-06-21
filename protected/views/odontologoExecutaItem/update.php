<?php
$this->breadcrumbs=array(
	'Odontologo Executa Items'=>array('index'),
	$model->odontologo_cpf=>array('view','id'=>$model->odontologo_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List odontologo_executa_item', 'url'=>array('index')),
	array('label'=>'Create odontologo_executa_item', 'url'=>array('create')),
	array('label'=>'View odontologo_executa_item', 'url'=>array('view', 'id'=>$model->odontologo_cpf)),
	array('label'=>'Manage odontologo_executa_item', 'url'=>array('admin')),
);
?>

<h1>Update odontologo_executa_item <?php echo $model->odontologo_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>