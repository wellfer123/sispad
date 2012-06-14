<?php
$this->breadcrumbs=array(
	'Medico Executa Metas'=>array('index'),
	$model->medico_cpf=>array('view','id'=>$model->medico_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List medico_executa_meta', 'url'=>array('index')),
	array('label'=>'Create medico_executa_meta', 'url'=>array('create')),
	array('label'=>'View medico_executa_meta', 'url'=>array('view', 'id'=>$model->medico_cpf)),
	array('label'=>'Manage medico_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Update medico_executa_meta <?php echo $model->medico_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>