<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paciente-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cns'); ?>
		<?php echo $form->textField($model,'cns',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'cns'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sexo'); ?>
		<?php echo $form->textField($model,'sexo',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'sexo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_nascimento'); ?>
		<?php echo $form->textField($model,'data_nascimento'); ?>
		<?php echo $form->error($model,'data_nascimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cidade'); ?>
		<?php echo $form->textField($model,'cidade',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'cidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nacionalidade'); ?>
		<?php echo $form->textField($model,'nacionalidade',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'nacionalidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idade'); ?>
		<?php echo $form->textField($model,'idade',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'idade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'raca'); ?>
		<?php echo $form->textField($model,'raca',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'raca'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'etnia'); ?>
		<?php echo $form->textField($model,'etnia',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'etnia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ultima_atualizacao'); ?>
		<?php echo $form->textField($model,'ultima_atualizacao'); ?>
		<?php echo $form->error($model,'ultima_atualizacao'); ?>
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