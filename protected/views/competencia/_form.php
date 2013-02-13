<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'competencia-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> têm preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mes_ano'); ?>
		<?php echo $form->textField($model,'mes_ano',array('length'=>6)); ?>
		<?php echo $form->error($model,'mes_ano'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->