<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'Gerenciamento de Departamentos', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Cadastro de Departamento</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>