<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoConsolidadaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'unidade'); ?>
                <?php echo Chtml::activeDropDownList($model, 'unidade_cnes', $unidades,array('empty'=>'Unidade')); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'profissao_codigo'); ?>
                <?php echo Chtml::activeDropDownList($model, 'profissao_codigo', $especialidades,array('empty'=>'')); ?>
	</div>
    
        <div class="row">
		<?php echo $form->label($model,'profissional_cpf'); ?>
                <?php $this->widget("EJuiAutoCompleteFkField", array(
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
                                )); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data'); ?>
                <?php $this->widget("zii.widgets.jui.CJuiDatePicker",array(
                                                "model"=>$model,
                                                "attribute"=>"data",
                                                "options"=>array(
                                                    "changeMonth"=>"true", 
                                                    "changeYear"=>"true",   
                                                    "yearRange" => "-99:+0", 
                                                    "showAnim"=>"fadeIn",
                                                ),
                                                "language"=>"pt",)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->