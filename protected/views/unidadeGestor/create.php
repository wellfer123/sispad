<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */

$this->breadcrumbs=array(
	'Unidade Gestor'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Unidade/Gestor', 'url'=>array('index')),
	array('label'=>'Gerenciar Unidade/Gestor', 'url'=>array('admin')),
);
?>

<h2></h2>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Cadastrar Unidade/Gestor",
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget();?>