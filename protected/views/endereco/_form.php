<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'endereco-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'logradouro'); ?>
		<?php echo $form->textField($model,'logradouro',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'logradouro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero'); ?>
		<?php echo $form->textField($model,'numero'); ?>
		<?php echo $form->error($model,'numero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'complemento'); ?>
		<?php echo $form->textField($model,'complemento',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'complemento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bairro'); ?>
		<?php echo $form->textField($model,'bairro',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'bairro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cidade_id'); ?>
		<?php echo $form->textField($model,'cidade_id'); ?>
		<?php echo $form->error($model,'cidade_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefone'); ?>
		<?php echo $form->textField($model,'telefone',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'telefone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->