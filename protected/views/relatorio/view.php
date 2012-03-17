<?php
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List relatorio', 'url'=>array('index')),
	array('label'=>'Create relatorio', 'url'=>array('create')),
	array('label'=>'Update relatorio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete relatorio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage relatorio', 'url'=>array('admin')),
);
?>

<h1>View relatorio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        //'cssFile' => Yii::app()->theme->baseUrl .'/css/profile.css',

	'attributes'=>array(
		'id',
                'servidor_cpf',
		'data_envio',
		'data_trabalho',
                array(
                    'name'=>'Arquivo',
                    'type'=>'raw',
                    'value'=> CHtml::link('Download',array('display','id'=>$model->id)),
                ),
               
	),
)); ?>

