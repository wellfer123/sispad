<?php
$this->breadcrumbs=array(
	'Servidores'=>array('admin'),
	$model->nome=>array('view','id'=>$model->cpf),
	'Atualização',
);

$this->menu=array(
	array('label'=>'Cadastrar Servidor', 'url'=>array('servidor/create')),
	array('label'=>'Visualizar Servidor', 'url'=>array('view', 'id'=>$model->cpf)),
	array('label'=>'Gerenciamento de Servidores', 'url'=>array('admin')),
);
?>


<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Atualização do Servidor:'.$model->nome ,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>

