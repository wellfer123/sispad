<?php
$this->breadcrumbs=array(
	'Metas'=>array('admin'),
	'Executadas por Odontólogos'=>array('Admin'),
        'Listagem',
);

$this->menu=array(
	array('label'=>'Create odontologo_executa_meta', 'url'=>array('create')),
	array('label'=>'Manage odontologo_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Odontologo Executa Metas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
