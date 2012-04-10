<?php
$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	'Cadastro',
);

$this->menu=array(
        array('label'=>'Gerencimento de Unidade', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Cadastro de Unidade</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>