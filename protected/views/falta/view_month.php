<?php
$this->breadcrumbs=array(
        'Faltas Mensais'=>array('Falta/preparedViewMonth'),
	'Relatorio Geral',
);

$this->menu=array(
	array('label'=>'Escolher outra Data', 'url'=>array('preparedViewMonth')),
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
