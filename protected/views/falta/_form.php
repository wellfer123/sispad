<?php Yii::import('application.services.FormataData');?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'falta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'dia'); ?>
		<?php echo $form->dropDownList($model,'dia',array('1'=>1,'2'=>2));?>
		<?php echo $form->error($model,'dia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'motivo'); ?>
		<?php echo $form->textField($model,'motivo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'motivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'motivo_id'); ?>
		<?php echo $form->textField($model,'motivo_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'motivo_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->