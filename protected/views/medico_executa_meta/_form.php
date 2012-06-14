<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'medico-executa-meta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'unidade_cnes'); ?>
		<?php echo $form->textField($model,'unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'unidade_cnes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_id'); ?>
		<?php echo $form->textField($model,'meta_id'); ?>
		<?php echo $form->error($model,'meta_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
		<?php echo $form->error($model,'total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_inicio'); ?>
		<?php echo $form->textField($model,'data_inicio'); ?>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_fim'); ?>
		<?php echo $form->textField($model,'data_fim'); ?>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->