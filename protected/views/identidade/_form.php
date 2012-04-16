<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'identidade-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'data_nascimento'); ?>
		<?php echo $form->textField($model,'data_nascimento'); ?>
		<?php echo $form->error($model,'data_nascimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero'); ?>
		<?php echo $form->textField($model,'numero',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'numero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orgao_expedidor'); ?>
		<?php echo $form->textField($model,'orgao_expedidor',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'orgao_expedidor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uf'); ?>
		<?php echo $form->textField($model,'uf',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'uf'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sexo'); ?>
		<?php echo $form->textField($model,'sexo',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'sexo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado_naturalidade_id'); ?>
		<?php echo $form->textField($model,'estado_naturalidade_id'); ?>
		<?php echo $form->error($model,'estado_naturalidade_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cidade_naturalidade_id'); ?>
		<?php echo $form->textField($model,'cidade_naturalidade_id'); ?>
		<?php echo $form->error($model,'cidade_naturalidade_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome_pai'); ?>
		<?php echo $form->textField($model,'nome_pai',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'nome_pai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome_mae'); ?>
		<?php echo $form->textField($model,'nome_mae',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'nome_mae'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->