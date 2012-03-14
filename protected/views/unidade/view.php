<?php
$this->breadcrumbs=array(
	'Unidade'=>array('index'),
	$model->nome,
);

$this->menu=array(
    
    
	array('label'=>'Lista de Unidades', 'url'=>array('index')),
	array('label'=>'Cadastro de Unidade', 'url'=>array('create')),
	array('label'=>'Atualização de Unidade', 'url'=>array('update', 'id'=>$model->cnes)),
	array('label'=>'Exclusão de Unidade', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cnes),'confirm'=>'Deseja realmente excluir essa unidade?')),
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
                'regional.regional_nome',
		'cidade.cidade_nome',
	),
)); ?>
