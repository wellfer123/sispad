<?php
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	'Data->'.FormataData::inverteDataComHora($model->data_trabalho,'-')=>array('view','id'=>$model->id),
	'Atualização',
);

$this->menu=array(
	array('label'=>'Listar relatórios', 'url'=>array('index')),
	array('label'=>'Enviar Relatório', 'url'=>array('create')),
	array('label'=>'Ver Relatório', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gerenciamento de Relatório', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Atualização de Relatório <?php echo FormataData::inverteDataComHora($model->data_trabalho,'-'); ?></h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>