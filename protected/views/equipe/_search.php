<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'codigo_segmento'); ?>
		<?php echo $form->textField($model,'codigo_segmento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_area'); ?>
		<?php echo $form->textField($model,'codigo_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unidade_cnes'); ?>
		<?php echo $form->textField($model,'unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_microarea'); ?>
		<?php echo $form->textField($model,'codigo_microarea'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->