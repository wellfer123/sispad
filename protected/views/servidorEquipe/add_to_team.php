<?php
$this->breadcrumbs=array(
	'Servidor'=>array('index'),
	'Adicionar à Equipe',
);


?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Adicionar Membros',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<?php echo $this->renderPartial('_form_add_to_team', array('model'=>$model)); ?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>


<?php $this->endWidget(); ?>