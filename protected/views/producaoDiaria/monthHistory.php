<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs=array(
	'Histórico da Produção Diária',
);

$this->menu=array(
	array('label'=>'Nenhuma', 'url'=>array('#')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producao-mensal-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('Pesquisa','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
        'especialidades'=>$especialidades,
        'unidades'=>$unidades,
)); ?>
</div><!-- search-form -->

<?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'producao-mensal-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'header'=>'Unidade',
                    'value'=>'$data->unidade',
                    'filter'=>$unidades,
                ),
                array(
                    'header'=>'Especialidade',
                    'value'=>'$data->especialidade',
                    'filter'=>$especialidades,
                ),
                array(
                    'header'=>'Jan',
                    'value'=>'$data->jan',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Fev',
                    'value'=>'$data->fev',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Mar',
                    'value'=>'$data->mar',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Abr',
                    'value'=>'$data->abr',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Mai',
                    'value'=>'$data->mai',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Jun',
                    'value'=>'$data->jun',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Jul',
                    'value'=>'$data->jul',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Ago',
                    'value'=>'$data->ago',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Set',
                    'value'=>'$data->set',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Out',
                    'value'=>'$data->out',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Nov',
                    'value'=>'$data->nov',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Dez',
                    'value'=>'$data->dez',
                    'filter'=>false,
                ),
                
                array(
                    'header'=>'Anual',
                    'value'=>'$data->anual',
                    'filter'=>false,
                ),
                array(
                    'class' => 'CButtonColumn',
                    'buttons' => array(
                        'delete' => array(
                            'visible' => 'false',
                        ),
                    ),
                ),
            ),
        ));
?>
