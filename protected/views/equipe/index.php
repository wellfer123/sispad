<?php
$this->breadcrumbs=array(
	'Equipes',
);

$this->menu=array(
	array('label'=>'Create Equipe', 'url'=>array('create')),
	array('label'=>'Manage Equipe', 'url'=>array('admin')),
);
?>

<h1>Equipes</h1>

<?php
   $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'codigo_segmento',
		'codigo_area',
		'tipo',
                array(
                    'name'=>'unidade',
                    'value'=>'$data->unidade->nome'
                ),
		
	),
));

?>

