<?php
$this->breadcrumbs=array(
	'Medico Executa Items'=>array('index'),
	$model->medico_cpf=>array('view','id'=>$model->medico_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List medico_executa_item', 'url'=>array('index')),
	array('label'=>'Create medico_executa_item', 'url'=>array('create')),
	array('label'=>'View medico_executa_item', 'url'=>array('view', 'id'=>$model->medico_cpf)),
	array('label'=>'Manage medico_executa_item', 'url'=>array('admin')),
);
?>

<h1>Update medico_executa_item <?php echo $model->medico_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>