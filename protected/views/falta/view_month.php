<?php
$this->breadcrumbs=array(
	'Faltas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Escolher outro Servidor ou Data', 'url'=>array('preparedCreate')),
);
?>
<?php
    $mes = $_GET['mes'];
    $ano = $_GET['ano'];
    $mes_model = Meses::model()->findByPk($mes);
    $title = "Faltas: $mes_model->nome / $ano ";
?>
<h2><?php echo $title;?></h2>

<?php echo CHtml::link("Gerar Relatório",array('relatorioMensal','title'=>$title,
   'mes'=>$mes,'ano'=>$ano));?>
<?php echo $this->renderPartial('_view_month', array('model'=>$model)); ?>
