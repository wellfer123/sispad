<?php
$this->breadcrumbs=array(
	'Setores',
);

$this->menu=array(
	array('label'=>'Cadastro de Setor', 'url'=>array('create')),
	array('label'=>'Gerenciamento de Setores', 'url'=>array('admin')),
);
?>

<h1>Setores</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
