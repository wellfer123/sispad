<?php
$this->breadcrumbs=array(
	'Unidade'=>array('index'),
	$model->nome,
);

$this->menu=array(
    
	array('label'=>'Cadastro de Unidade', 'url'=>array('create')),
	array('label'=>'Atualização de Unidade', 'url'=>array('update', 'id'=>$model->cnes)),
	array('label'=>'Gerencimento de Unidade', 'url'=>array('admin')),
);
?>

<h1>Unidade </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cnes',
		'descricao',
		'nome',
                array(
                    'label'=>'Regional',
                    'value'=>$model->regional->regional_nome,
                ),
                 array(
                    'label'=>'Cidade',
                    'value'=>$model->cidade->cidade_nome,
                ),
	),
)); ?>
