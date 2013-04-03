<?php
/* @var $this ProfissionalVinculoController */
/* @var $model ProfissionalVinculo */

$this->breadcrumbs=array(
	'Profissional Vinculos'=>array('index'),
	'Create',
);

$this->menu=array(
	
);
?>

<h1>Cadastrar Vinculo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<p>
<h2>Unidade: <?php echo $unidade?></h2>
<?php echo $this->renderPartial('_list', array('dataProvider'=>$dataProvider)); ?>