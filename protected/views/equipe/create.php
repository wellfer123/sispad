<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Equipes', 'url'=>array('index')),
	array('label'=>'Administrar Equipes', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Cadastrar Equipe",
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget();?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>