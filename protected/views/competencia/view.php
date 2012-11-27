<?php
$this->breadcrumbs=array(
	'Competências'=>array('index'),
	'Visualização',
);

$this->menu=array(
	array('label'=>'Listar Competências', 'url'=>array('index')),
	array('label'=>'Cadastrar Competência', 'url'=>array('create')),
	array('label'=>'Administrar Competências', 'url'=>array('admin')),
);
?>
<div class="update">
<h2>Competencia <?php echo $model->mes_ano; ?></h2>

</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mes_ano',
		array(
                    'name'=>'Status',
                    'value'=>$model->labelStatus(),
                ),
	),
)); ?>
