<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dados-trabalho-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'data_admissao'); ?>
		<?php echo $form->textField($model,'data_admissao'); ?>
		<?php echo $form->error($model,'data_admissao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pis'); ?>
		<?php echo $form->textField($model,'pis',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'pis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_horaria'); ?>
		<?php echo $form->textField($model,'carga_horaria'); ?>
		<?php echo $form->error($model,'carga_horaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'turno'); ?>
		<?php echo $form->textField($model,'turno',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'turno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profissao'); ?>
		<?php echo $form->textField($model,'profissao',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'profissao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salario'); ?>
		<?php echo $form->textField($model,'salario',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'salario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'conselho_classe'); ?>
		<?php echo $form->textField($model,'conselho_classe',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'conselho_classe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_afastamento'); ?>
		<?php echo $form->textField($model,'data_afastamento'); ?>
		<?php echo $form->error($model,'data_afastamento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_retorno'); ?>
		<?php echo $form->textField($model,'data_retorno'); ?>
		<?php echo $form->error($model,'data_retorno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'situacao_funcional'); ?>
		<?php echo $form->textField($model,'situacao_funcional',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'situacao_funcional'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vinculo'); ?>
		<?php echo $form->textField($model,'vinculo',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'vinculo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->