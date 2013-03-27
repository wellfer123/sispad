<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */

$this->breadcrumbs=array(
	'Producao Diarias'=>array('index'),
	$model->unidade_cnes=>array('view','id'=>$model->unidade_cnes),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProducaoDiaria', 'url'=>array('index')),
);
?>

<h1>Update ProducaoDiaria <?php echo $model->unidade_cnes; ?></h1>

<?php echo $this->renderPartial('_form', 
                                array(
                                    'data'=>$data,
                                    'itens'=>$itens,
                                    'especialidades'=>$especialidades,
                                    'servidor'=>$servidor)); ?>