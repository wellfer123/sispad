<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'relatorio-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'conteudo'); ?>
		<?php echo $form->textArea($model,'conteudo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'conteudo'); ?>
	</div>

	<div class="row">




                <?php echo 'teste' ?>
		<?php echo $form->labelEx($model,'data_envio'); ?>
		<?php echo $form->textField($model,'data_envio'); ?>
		<?php echo $form->error($model,'data_envio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_trabalho'); ?>
		<?php echo $form->textField($model,'data_trabalho'); ?>
		<?php echo $form->error($model,'data_trabalho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf'); ?>
		<?php echo $form->error($model,'servidor_cpf'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->