<?php
$this->breadcrumbs=array(
	'Procedimento Realizados'=>array('index'),
	$model->unidade=>array('view','id'=>$model->unidade),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProcedimentoRealizado', 'url'=>array('index')),
	array('label'=>'Create ProcedimentoRealizado', 'url'=>array('create')),
	array('label'=>'View ProcedimentoRealizado', 'url'=>array('view', 'id'=>$model->unidade)),
	array('label'=>'Manage ProcedimentoRealizado', 'url'=>array('admin')),
);
?>

<h1>Update ProcedimentoRealizado <?php echo $model->unidade; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>