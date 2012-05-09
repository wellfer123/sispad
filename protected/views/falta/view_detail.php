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
    $cpf = $_GET['cpf'];
    $mes = $_GET['mes'];
    $ano = $_GET['ano'];
    $servidor = Servidor::model()->findByPk($cpf);
    $mes_model = Meses::model()->findByPk($mes);
    $title = "Faltas: $servidor->nome - $mes_model->nome / $ano ";
?>
<h2><?php echo $title;?></h2>

<?php echo CHtml::link("Gerar Relatório",array('relatorioDetalhado','title'=>$title,
    'servidorCpf'=>$cpf,'mes'=>$mes,'ano'=>$ano));?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
