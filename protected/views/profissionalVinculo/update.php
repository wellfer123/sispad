<?php
/* @var $this ProfissionalVinculoController */
/* @var $model ProfissionalVinculo */

$this->breadcrumbs=array(
	'Profissional Vinculos'=>array('index'),
	$model->cpf=>array('view','id'=>$model->cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProfissionalVinculo', 'url'=>array('index')),
	array('label'=>'Create ProfissionalVinculo', 'url'=>array('create')),
	array('label'=>'View ProfissionalVinculo', 'url'=>array('view', 'id'=>$model->cpf)),
	array('label'=>'Manage ProfissionalVinculo', 'url'=>array('admin')),
);
?>

<h1>Update ProfissionalVinculo <?php echo $model->cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>