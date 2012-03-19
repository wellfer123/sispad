<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'total-relatorio-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mes'); ?>
		<?php echo $form->textField($model,'mes'); ?>
		<?php echo $form->error($model,'mes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantidade'); ?>
		<?php echo $form->textField($model,'quantidade'); ?>
		<?php echo $form->error($model,'quantidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_envio'); ?>
		<?php echo $form->textField($model,'data_envio'); ?>
		<?php echo $form->error($model,'data_envio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'servidor_cpf'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->