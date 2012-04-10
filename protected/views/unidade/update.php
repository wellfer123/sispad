<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	$model->cnes=>array('view','id'=>$model->cnes),
	'Update',
);

$this->menu==array(
    
	
	array('label'=>'Cadastro de Unidade', 'url'=>array('create')),
        array('label'=>'Ver Unidade', 'url'=>array('view', 'id'=>$model->cnes)),
        array('label'=>'Gerencimento de Unidade', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Atualização da Unidade <?php echo $model->nome; ?></h1>
<div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>