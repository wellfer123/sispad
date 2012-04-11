<?php
$this->breadcrumbs=array(
	'Frequências'=>array('index'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Gerenciamento de Frequências', 'url'=>array('admin')),
);
?>
<div class="form">
<h1>Envio de Frequência</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>