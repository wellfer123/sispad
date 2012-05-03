<?php
$this->breadcrumbs=array(
	'Faltas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Escolher outro Servidor ou Data', 'url'=>array('preparedCreate')),
);
?>
<?php $servidor = Servidor::model()->findByPk($_GET['cpf']);
      $mes = Meses::model()->findByPk($_GET['mes']);
?>
<h2><?php echo "Faltas: ".$servidor->nome.' - '. $mes->nome.'/'.$_GET['ano'];?></h2>
<?php echo CHtml::link("Gerar Relatório",array('relatorioDetalhado','title'=>'teste',
    'servidorCpf'=>$_GET['cpf'],'mes'=>$_GET['mes'],'ano'=>$_GET['ano']));?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
