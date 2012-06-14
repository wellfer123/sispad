<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
	"Equipe ".$model->codigo_area,
);

$this->menu=array(
	array('label'=>'Listar Equipes', 'url'=>array('index')),
	array('label'=>'Criar Equipes', 'url'=>array('create')),
	array('label'=>'Atualizar Equipe', 'url'=>array('update','area'=>$model->codigo_area,'cnes'=>$model->unidade_cnes)),
	array('label'=>'Administrar Equipes', 'url'=>array('admin')),
        array('label'=>'Gerenciar Membros', 'url'=>array('servidorEquipe/adminMembers',
              'codigo_area'=>$model->codigo_area,'unidade_cnes'=>$model->unidade_cnes
        )),
);
?>

<h1>View Equipe #<?php echo $model->codigo_area; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codigo_segmento',
		'codigo_area',
		'tipo',
		'unidade_cnes',
		
	),
)); ?>

<?php $model2 = new ServidorEquipe;
      echo $this->renderPartial('//servidorEquipe/_view', array('model'=>$model2)); ?>
