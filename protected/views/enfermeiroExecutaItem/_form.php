<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enfermeiro-executa-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'item_id'); ?>
		<?php echo $form->textField($model,'item_id'); ?>
		<?php echo $form->error($model,'item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enfermeiro_unidade_cnes'); ?>
		<?php echo $form->textField($model,'enfermeiro_unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'enfermeiro_unidade_cnes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantidade'); ?>
		<?php echo $form->textField($model,'quantidade'); ?>
		<?php echo $form->error($model,'quantidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'competencia'); ?>
		<?php echo $form->textField($model,'competencia'); ?>
		<?php echo $form->error($model,'competencia'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->