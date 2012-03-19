<?php
$this->breadcrumbs=array(
	'Frequências'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'Gerenciar Frequências', 'url'=>array('admin')),
);
?>

<h1>Frequência</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>