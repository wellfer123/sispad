<?php
$nomeServidor = $_GET['serv'];
$this->breadcrumbs=array(
        'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
	'Título de Eleitor de '.$servidor->nome,
);

$this->menu=array(
        array('label'=>'Visualizar Servidor', 'url'=>array('Servidor/view','id'=>$servidor->cpf)),
	array('label'=>'Atualizar Título de Eleitor', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
);
?>

<div class="update">
<h2>Título de Eleitor de <?php echo $servidor->nome ?></h2>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
                array(
                       'label'=>'Servidor',
                       'value'=>$servidor->nome,
                ),
		'numero',
		'zona',
		'secao',
	),
)); ?>
