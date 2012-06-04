<?php
$nomeServidor = $_GET['serv'];
$this->breadcrumbs=array(
        'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
	'Titulo de Eleitor de '.$nomeServidor,
);

$this->menu=array(
	array('label'=>'Update TituloEleitor', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
);
?>

<h1>Titulo de Eleitor de <?php echo $nomeServidor ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'numero',
		'zona',
		'secao',
	),
)); ?>
