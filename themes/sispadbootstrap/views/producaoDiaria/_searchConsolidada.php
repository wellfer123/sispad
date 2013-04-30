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
                <?php echo Chtml::activeDropDownList($model, 'unidade', $unidades,array('empty'=>'Unidade')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data'); ?>
                <?php $this->widget("zii.widgets.jui.CJuiDatePicker",array(
                                                "name"=>"data",
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