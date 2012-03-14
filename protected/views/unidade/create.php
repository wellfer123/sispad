<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Lista de Unidades', 'url'=>array('index')),
        array('label'=>'Gerencimento de Unidade', 'url'=>array('admin')),
);
?>

<h1>Create Unidade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>