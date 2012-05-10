<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipe-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_segmento'); ?>
		<?php echo $form->textField($model,'codigo_segmento'); ?>
		<?php echo $form->error($model,'codigo_segmento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo'); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unidade_cnes'); ?>
		<?php echo $form->textField($model,'unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'unidade_cnes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_microarea'); ?>
		<?php echo $form->textField($model,'codigo_microarea'); ?>
		<?php echo $form->error($model,'codigo_microarea'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->