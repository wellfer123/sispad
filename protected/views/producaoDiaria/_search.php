<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'unidade_cnes'); ?>
                <?php echo Chtml::activeDropDownList($model, 'unidade_cnes', $unidades); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profissao_codigo'); ?>
                <?php echo Chtml::activeDropDownList($model, 'profissao_codigo', $especialidades); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data'); ?>
		<?php echo $form->textField($model,'data'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->