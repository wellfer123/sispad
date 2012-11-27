<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'procedimento-realizado-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'unidade'); ?>
		<?php echo $form->textField($model,'unidade',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'unidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'competencia'); ?>
		<?php echo $form->textField($model,'competencia',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'competencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profissional_cns'); ?>
		<?php echo $form->textField($model,'profissional_cns',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'profissional_cns'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profissional_cbo'); ?>
		<?php echo $form->textField($model,'profissional_cbo',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'profissional_cbo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'folha'); ?>
		<?php echo $form->textField($model,'folha',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'folha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sequencia'); ?>
		<?php echo $form->textField($model,'sequencia',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'sequencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'procedimento'); ?>
		<?php echo $form->textField($model,'procedimento',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'procedimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paciente_cns'); ?>
		<?php echo $form->textField($model,'paciente_cns',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'paciente_cns'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_atendimento'); ?>
		<?php echo $form->textField($model,'data_atendimento'); ?>
		<?php echo $form->error($model,'data_atendimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cid'); ?>
		<?php echo $form->textField($model,'cid',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantidade'); ?>
		<?php echo $form->textField($model,'quantidade',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'quantidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'caracter_atendimento'); ?>
		<?php echo $form->textField($model,'caracter_atendimento',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'caracter_atendimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero_autorizacao'); ?>
		<?php echo $form->textField($model,'numero_autorizacao',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'numero_autorizacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origem'); ?>
		<?php echo $form->textField($model,'origem',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'origem'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'competencia_movimento'); ?>
		<?php echo $form->textField($model,'competencia_movimento',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'competencia_movimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'servico'); ?>
		<?php echo $form->textField($model,'servico',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'servico'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'equipe'); ?>
		<?php echo $form->textField($model,'equipe',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'equipe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'classificacao'); ?>
		<?php echo $form->textField($model,'classificacao',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'classificacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_cadastro'); ?>
		<?php echo $form->textField($model,'data_cadastro'); ?>
		<?php echo $form->error($model,'data_cadastro'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->