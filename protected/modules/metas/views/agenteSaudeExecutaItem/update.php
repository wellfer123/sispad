<?php
$this->breadcrumbs=array(
	'Agente Saude Executa Items'=>array('index'),
	$model->agente_saude_cpf=>array('view','id'=>$model->agente_saude_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List agente_saude_executa_item', 'url'=>array('index')),
	array('label'=>'Create agente_saude_executa_item', 'url'=>array('create')),
	array('label'=>'View agente_saude_executa_item', 'url'=>array('view', 'id'=>$model->agente_saude_cpf)),
	array('label'=>'Manage agente_saude_executa_item', 'url'=>array('admin')),
);
?>

<h1>Update agente_saude_executa_item <?php echo $model->agente_saude_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>