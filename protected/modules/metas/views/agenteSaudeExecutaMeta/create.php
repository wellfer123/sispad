<?php
$this->breadcrumbs=array(
        'Meta'=>array('admin'),
	'Agente Saude Executa Metas'=>array('index'),
	'Envio',
);

$this->menu=array(
	array('label'=>'List agente_saude_executa_meta', 'url'=>array('index')),
	array('label'=>'Manage agente_saude_executa_meta', 'url'=>array('admin')),
);
?>

<h1>Create agente_saude_executa_meta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>