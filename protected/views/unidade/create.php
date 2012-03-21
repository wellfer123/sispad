<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	'Cadastro',
);

$this->menu=array(
        array('label'=>'Gerencimento de Unidade', 'url'=>array('admin')),
);
?>

<h1>Cadastro de Unidade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>