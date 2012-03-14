<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	$model->cnes=>array('view','id'=>$model->cnes),
	'Update',
);

$this->menu==array(
    
	array('label'=>'Lista de Unidades', 'url'=>array('index')),
	array('label'=>'Cadastro de Unidade', 'url'=>array('create')),
        array('label'=>'Ver Unidade', 'url'=>array('view', 'id'=>$model->cnes)),
        array('label'=>'Gerencimento de Unidade', 'url'=>array('admin')),
);
?>

<h1>Atualização de Unidade <?php echo $model->cnes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>