<?php
/* @var $this EspecialidadeGrupoController */
/* @var $model EspecialidadeGrupo */

$this->breadcrumbs=array(
	'Especialidade Grupo'=>array('index'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Lista Especialidade/Grupo', 'url'=>array('index')),
	array('label'=>'Gerencia Especialidade/Grupo', 'url'=>array('admin')),
);
?>

<h1>Cadastrar Especialidade/Grupo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'especialidade-grupo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
                array(
                    'header'=>'Especialidade',
                    'value'=>'$data->especialidade->nome'
                ),
                array(
                    'header'=>'Grupo',
                    'value'=>'$data->grupo->nome',
                ),
		array(
			'class'=>'CButtonColumn',
                         'template'=>'',
                         
		),
	),
)); ?>