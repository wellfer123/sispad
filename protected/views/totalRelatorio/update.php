<?php
$this->breadcrumbs=array(
	'Total Relatorios'=>array('index'),
	$model->ano=>array('view','id'=>$model->ano),
	'Update',
);

$this->menu=array(
	array('label'=>'List TotalRelatorio', 'url'=>array('index')),
	array('label'=>'Create TotalRelatorio', 'url'=>array('create')),
	array('label'=>'View TotalRelatorio', 'url'=>array('view', 'id'=>$model->ano)),
	array('label'=>'Manage TotalRelatorio', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Update TotalRelatorio <?php echo $model->ano; ?></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>