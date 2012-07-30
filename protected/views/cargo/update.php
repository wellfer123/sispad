<?php
$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	$model->nome=>array('view','id'=>$model->id),
	'Atualização',
);

$this->menu=array(
	array('label'=>'Listar Cargos', 'url'=>array('index')),
	array('label'=>'Cadastrar Cargo', 'url'=>array('create')),
	array('label'=>'Ver Cargo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Cargos', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Atualização do cargo '.$model->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>