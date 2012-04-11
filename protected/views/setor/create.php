<?php
$this->breadcrumbs=array(
	'Setores'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'Gerenciamento de Setores', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Cadastro de Setor</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>