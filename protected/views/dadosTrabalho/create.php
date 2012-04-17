<?php
$this->breadcrumbs=array(
	'Dados Trabalhos'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'List DadosTrabalho', 'url'=>array('index')),
	array('label'=>'Manage DadosTrabalho', 'url'=>array('admin')),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro de dados de trabalho do servidor: ',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->endWidget(); ?>