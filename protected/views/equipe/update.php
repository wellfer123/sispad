<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
	$model->codigo_area=>array('view','id'=>$model->codigo_area),
	'Update',
);

$this->menu=array(
	array('label'=>'List Equipe', 'url'=>array('index')),
	array('label'=>'Create Equipe', 'url'=>array('create')),
	array('label'=>'View Equipe', 'url'=>array('view', 'id'=>$model->codigo_segmento)),
	array('label'=>'Manage Equipe', 'url'=>array('admin')),
        array('label'=>'Manage Membros', 'url'=>array('servidorEquipe/adminMembers',
              'codigo_area'=>$model->codigo_area,'unidade_cnes'=>$model->unidade_cnes
        )),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Alterar Equipe ".$model->codigo_area,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget();?>