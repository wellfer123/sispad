<?php
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Relatórios', 'url'=>array('index')),
	array('label'=>'Gerenciamento de relatórios', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Envio de relatório</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>