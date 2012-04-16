<?php
$this->breadcrumbs=array(
	'Dados Trabalhos'=>array('index'),
	$model->servidor_cpf=>array('view','id'=>$model->servidor_cpf),
	'Update',
);

$this->menu=array(
	array('label'=>'List DadosTrabalho', 'url'=>array('index')),
	array('label'=>'Create DadosTrabalho', 'url'=>array('create')),
	array('label'=>'View DadosTrabalho', 'url'=>array('view', 'id'=>$model->servidor_cpf)),
	array('label'=>'Manage DadosTrabalho', 'url'=>array('admin')),
);
?>

<h1>Update DadosTrabalho <?php echo $model->servidor_cpf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>