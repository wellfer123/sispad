<?php Yii::import('application.services.FormataData');//include 'protected/services/FormataData.php'?>
<?php
$this->breadcrumbs=array(
	'Relatorios',
);

$this->menu=array(
	array('label'=>'Enviar Relatório', 'url'=>array('create')),
	array('label'=>'Gerenciar Relatórios', 'url'=>array('admin')),
);
?>

<h1>Relatorios</h1>

<?php

    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'relatorio-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		array(
                    'name'=>'Data do Trabalho',
                    'value'=> 'FormataData::inverteData($data->data_trabalho,"-")',
                ),
		array(
			'class'=>'CButtonColumn',
                         'template'=>'{view}{update}',
		),
	),
));

    
        ?>
<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */?>
