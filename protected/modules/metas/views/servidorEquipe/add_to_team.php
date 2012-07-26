<?php
$this->breadcrumbs=array(
        'Equipes'=>array('equipe/index'),
        'Equipe '.$model->equipe_codigo_area=>array("equipe/view","area"=>$model->equipe_codigo_area,
                        "cnes"=>$model->equipe_unidade_cnes),
	'Adicionar à Equipe',
);

$this->menu=array(
	array('label'=>'Gerenciar Membros', 'url'=>array('servidorEquipe/adminMembers',"codigo_area"=>$model->equipe_codigo_area,
                                                            "unidade_cnes"=>$model->equipe_unidade_cnes)),
);

?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Adicionar Membros',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_add_to_team', array('model'=>$model)); ?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>


<?php $this->endWidget(); ?>