<?php
$this->breadcrumbs=array(
	'Dados Trabalhos',
);

$this->menu=array(
	array('label'=>'Create DadosTrabalho', 'url'=>array('create')),
	array('label'=>'Manage DadosTrabalho', 'url'=>array('admin')),
);
?>

<h1>Dados Trabalhos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
