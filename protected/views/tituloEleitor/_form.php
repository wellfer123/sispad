<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'titulo-eleitor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'numero'); ?>
		<?php echo $form->textField($model,'numero',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'numero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zona'); ?>
		<?php echo $form->textField($model,'zona',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'zona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'secao'); ?>
		<?php echo $form->textField($model,'secao',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'secao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->