<?php
$this->breadcrumbs=array(
	'Setores'=>array('index'),
	$model->nome=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Cadastro de Setor', 'url'=>array('create')),
	array('label'=>'Ver Setor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gerenciamento de Setores', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Atualização do Setor <?php echo $model->nome; ?></h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>