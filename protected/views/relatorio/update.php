<?php

$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	'Data->'.$model->data_trabalho=>array('view','id'=>$model->id),
	'Atualização',
);

$this->menu=array(
	array('label'=>'Listar relatórios', 'url'=>array('index')),
	array('label'=>'Enviar Relatório', 'url'=>array('create')),
	array('label'=>'Ver Relatório', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gerenciamento de Relatório', 'url'=>array('admin')),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Atualização de Relatório',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget(); ?>