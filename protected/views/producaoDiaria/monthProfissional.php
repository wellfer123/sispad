<?php
Yii::import('application.services.HighChartsUtil');
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
<?php $this->renderPartial('_searchProfissional',array(
	'model'=>$model,
        'anos'=>$anos,
        'unidades'=>$unidades,
        'relatorio'=>$relatorio,
        'profissionais'=>$profissionais,
)); ?>

<?php
        $dataProvider = $model->search();
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'producao-mensal-grid',
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(
                    'header'=>'Profissional',
                    'value'=>'$data->profissional',
                    'filter'=>false,
                ),
                array(
                    'header'=>'Grupo',
                    'value'=>'$data->grupo',
                    'filter'=>false,
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
            ),
        ));
?>

<?php 

     $labels=array('jan','fev','mar','abr','mai','jun','jul','ago','set','out','nov','dez');
    $this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
      'chart'=>array('type'=>'column'),
      'title' => array('text' => 'Profissionais/Grupos'),
      'xAxis' => array(
         'categories' => array('Jan', 'Fev', 'Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez')
      ),
      'yAxis' => array(
         'title' => array('text' => 'Quantidade Executada')
      ),
      'plotOptions'=>array(
                        'series'=>array(
                                'dataLabels'=>array(
                                    'enabled'=>true,
                                ),
                        ),
       ),
       'labels'=>array('rotation'=>-45,
                        'align'=>'right'
                      ),
      'series' =>HighChartsUtil::getSeriesCharts($dataProvider,'grupo',$labels,false),//array(
         //array('name' => 'MEDICO GINECOLOGISTA E OBSTETRA', 'data' => array(0, 0,0,191,0,0,0,0,0,0,0,0,191)),
         //array('name' => 'MEDICO CLINICO', 'data' => array(10, 10,10,10,0,0,0,0,0,0,0,0,191)),
         //array('name' => 'John', 'data' => array(5, 7, 3))
      //)
   )
));?>

