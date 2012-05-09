<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'procedimento-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_complexidade'); ?>
		<?php echo $form->textField($model,'tipo_complexidade',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'tipo_complexidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_sexo'); ?>
		<?php echo $form->textField($model,'tipo_sexo',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'tipo_sexo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantidade_maxima_execucao'); ?>
		<?php echo $form->textField($model,'quantidade_maxima_execucao',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'quantidade_maxima_execucao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantidade_dias_permanencia'); ?>
		<?php echo $form->textField($model,'quantidade_dias_permanencia',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'quantidade_dias_permanencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantidade_pontos'); ?>
		<?php echo $form->textField($model,'quantidade_pontos',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'quantidade_pontos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validade_idade_minima'); ?>
		<?php echo $form->textField($model,'validade_idade_minima',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'validade_idade_minima'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validade_idade_maxima'); ?>
		<?php echo $form->textField($model,'validade_idade_maxima',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'validade_idade_maxima'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validade_sh'); ?>
		<?php echo $form->textField($model,'validade_sh',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'validade_sh'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validade_sa'); ?>
		<?php echo $form->textField($model,'validade_sa',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'validade_sa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validade_sp'); ?>
		<?php echo $form->textField($model,'validade_sp',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'validade_sp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_financiamento'); ?>
		<?php echo $form->textField($model,'codigo_financiamento',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'codigo_financiamento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_rubrica'); ?>
		<?php echo $form->textField($model,'codigo_rubrica',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'codigo_rubrica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_competencia'); ?>
		<?php echo $form->textField($model,'data_competencia',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'data_competencia'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->