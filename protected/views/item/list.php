<?php
$this->breadcrumbs=array(
        'Indicador'=>array('indicador/admin'),
	'Metas'=>array('meta/view',"indicador_id"=>$_GET['indicador_id']),
	'Itens',
);

?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
