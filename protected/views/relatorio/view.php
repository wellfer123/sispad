<?php
Yii::import('application.services.FormataData');
$this->breadcrumbs=array(
	'Relatorios'=>array('index'),
	$model->data_trabalho,
);

$this->menu=array(
	array('label'=>'Listar meus relatórios', 'url'=>array('index')),
	array('label'=>'Enviar relatório', 'url'=>array('create')),
	array('label'=>'Atualizar relatório', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Gerenciamento de relatório', 'url'=>array('admin')),
);
?>
<div class="update">
<h1>Relatório</h1>
</div>
<?php
    


$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        //'cssFile' => Yii::app()->theme->baseUrl .'/css/profile.css',

	'attributes'=>array(
		'id',
		//'data_envio',
                 array(
                    'name'=>'Data Envio',
                    'value'=> FormataData::inverteDataComHora($model->data_envio, "-") ,
                ),
                'servidor_cpf',
               'data_trabalho',
		/*array(
                    'name'=>'Data Trabalho',
                    'value'=> FormataData::inverteData($model->data_trabalho,"-"),
                ),*/
                array(
                    'name'=>'Arquivo',
                    'type'=>'raw',
                    'value'=> CHtml::link($model->temp_arquivo->file_name,array('display','id'=>$model->id)),
                ),
               
	),
)); ?>

