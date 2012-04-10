<?php
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List relatorio', 'url'=>array('index')),
	array('label'=>'Create relatorio', 'url'=>array('create')),
	array('label'=>'View relatorio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage relatorio', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Update relatorio <?php echo $model->id; ?></h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>