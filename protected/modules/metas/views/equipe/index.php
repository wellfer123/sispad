<?php
$this->breadcrumbs=array(
	'Equipes',
);

$this->menu=array(
	array('label'=>'Criar Equipe', 'url'=>array('create')),
	array('label'=>'Gerenciar Equipes', 'url'=>array('admin')),
);
?>

<h1>Equipes</h1>

<?php
   $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipe-grid',
	'dataProvider'=>$model->search(),
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

