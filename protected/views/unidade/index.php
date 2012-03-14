<?php
$this->breadcrumbs=array(
	'Unidades',
);

$this->menu=array(
	array('label'=>'Lista de Unidades', 'url'=>array('index')),
	array('label'=>'Cadastro de Unidade', 'url'=>array('create')),
	array('label'=>'Atualização de Unidade', 'url'=>array('update', 'id'=>$model->cnes)),
	array('label'=>'Gerencimento de Unidade', 'url'=>array('admin')),
);
?>

<h1>Unidades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
