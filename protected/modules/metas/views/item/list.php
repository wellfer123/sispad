<?php
$this->breadcrumbs=array(
        'Indicador'=>array('indicador/admin'),
	'Metas'=>array('meta/view',"indicador_id"=>$_GET['indicador_id']),
	'Itens',
);
$this->menu=array(
	
	array('label'=>'Criar Item', 'url'=>array('create','indicador_id'=>$_GET['indicador_id'])),
	
);
?>
<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
