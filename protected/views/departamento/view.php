<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Cadastro de Departamento', 'url'=>array('create')),
	array('label'=>'Atualização de Departamento', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Gerenciamento de Departamentos', 'url'=>array('admin')),
);
?>
<div class="update">
<h1>Departamento: <?php echo $model->nome; ?></h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'descricao',
                array(
                    'label'=>'Unidade',
                    'value'=>$model->unidade->nome,
                ),
	),
)); ?>
