<?php

$this->breadcrumbs=array(
         'Indicador'=>array('indicador/admin'),
	'Metas',
);

$this->menu=array(
	array('label'=>'Adicionar Meta', 'url'=>array("/meta/create","indicador_id"=>$_GET['indicador_id'])),
);


?>

<h1>Metas</h1>

<?php echo $this->renderPartial('_admin', array('model'=>$model)); ?>


                     


