<?php
$this->breadcrumbs=array(
	'Odontologo Executa Items',
);

$this->menu=array(
	array('label'=>'Enviar nova execução de meta', 'url'=>array('OdontologoExecutaMeta/send')),
	array('label'=>'Gerenciamento de itens executados por Odontologo', 'url'=>array('admin')),
);
?>

<h1>Itens executados por Odontólogo</h1>

<?php echo $this->renderMessages(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'odontologo-executa-item-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                        'name'=>'Odontólogo',
                        'value'=>'$data->odontologo->servidor->nome',
                ),
                array(
                        'name'=>'Unidade',
                        'value'=>'$data->odontologo->servidor->unidade->nome',
                ),
                array(
                        'name'=>'Item',
                        'value'=>'$data->item->nome',
                ),
		'quantidade',
		'competencia',
                array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                                'delete'=>array(
                                                'visible'=>'false',
                                ),
                                'update'=>array(
                                                'visible'=>'false',
                                ),
                                'view'=>array(
                                                'url'=> 'Yii::app()->createUrl("/OdontologoExecutaItem/view",
                                                        array("servidor"=>$data->odontologo_cpf,"item"=>$data->item_id,"competencia"=>$data->competencia,"unidade"=>$data->odontologo_unidade_cnes))',
                                ),
                        )
		),
	),
)); ?>
