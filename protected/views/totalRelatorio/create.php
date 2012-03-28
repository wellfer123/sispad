<?php
$this->breadcrumbs=array(
	'Quantidade de Relatórios'=>array('index'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Gerenciamento de Relatórios Enviados', 'url'=>array('admin')),
);
?>

<h1>Envio da Quantidade de Relatórios</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>