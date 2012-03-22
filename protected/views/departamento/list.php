<?php
$this->breadcrumbs=array(
	'Departamentos',
);

$this->menu=array(
	array('label'=>'Cadastro Departamento', 'url'=>array('create')),
	array('label'=>'Gerenciamento de Departamentos', 'url'=>array('admin')),
);
?>

<h1>Departamentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
