<?php
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List relatorio', 'url'=>array('index')),
	array('label'=>'Manage relatorio', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Novo relatório</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>