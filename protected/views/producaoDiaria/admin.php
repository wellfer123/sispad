<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */

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
	$('#producao-diaria-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producao-diaria-grid',
	'dataProvider'=>$model->search(),
        'afterAjaxUpdate'=>"function(){ jQuery('#data').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['pt'],{'changeMonth':'true','changeYear':'true','yearRange':'-99:+0','showAnim':'fadeIn'}));  
                                        jQuery('#ProducaoDiaria_profissional_cpf_lookup').autocomplete({'minLength':4,'maxHeight':'100','create':function(event, ui){ $(this).val('');},'select':function(event, ui){  $('#ProducaoDiaria_profissional_cpf').val(ui.item.id);$('#ProducaoDiaria_profissional_cpf_save').val(ui.item.value);},'source':'/sispad/index.php/Servidor/findServidores'});
                                    }",
	'filter'=>$model,
	'columns'=>array(
                array(
                    'name'=>'unidade_cnes',
                    'value'=>'$data->unidade->nome',
                    'filter'=>$unidades,
                ),
                array(
                    'name'=>'profissao_codigo',
                    'value'=>'$data->especialidade->nome',
                    'filter'=>$especialidades,
                ),
                array(
                    'filter'=>$this->widget("EJuiAutoCompleteFkField", array(
                                    "model"=>$model,
                                    "attribute"=>"profissional_cpf", 
                                    "sourceUrl"=>Yii::app()->createUrl("Servidor/findServidores"),
                                    "showFKField"=>false,
                                    "FKFieldSize"=>11, 
                                    "displayAttr"=>"nome",  
                                    "autoCompleteLength"=>60,
                                    "options"=>array(
                                        "minLength"=>4,
                                        ),
                                ),true),
                    'header'=>'Profissional',
                    'value'=>'$data->profissional->nome'
                ),
                array(
                    'filter'=>false,
                    'name'=>'quantidade',
                    'value'=>'$data->quantidade'
                ),
                array(
                    'name'=>'data',
                    'value'=>'ParserDate::inverteDataEnToPt($data->data)',
                    'filter'=>$this->widget("zii.widgets.jui.CJuiDatePicker",array(
                                                "name"=>"data",
                                                "options"=>array(
                                                    "changeMonth"=>"true", 
                                                    "changeYear"=>"true",   
                                                    "yearRange" => "-99:+0", 
                                                    "showAnim"=>"fadeIn",
                                                ),
                                                "language"=>"pt",), true),
                ),
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
                                                'url'=> 'Yii::app()->createUrl("producaoDiaria/view",
                                                        array("e"=>$data->profissao_codigo,"d"=>$data->data,"u"=>$data->unidade_cnes))',
                                ),
                        )
		),
	),
)); ?>
