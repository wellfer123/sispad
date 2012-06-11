<?php
$this->breadcrumbs=array(
	'Equipes'=>array('index'),
        'Equipe '.$model->codigo_area=>array("equipe/view","area"=>$model->codigo_area,
                        "cnes"=>$model->unidade_cnes),
	'Update',
);

$this->menu=array(
	array('label'=>'Gerenciar Equipe', 'url'=>array('admin')),
        array('label'=>'Gerenciar Membros', 'url'=>array('servidorEquipe/adminMembers',
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