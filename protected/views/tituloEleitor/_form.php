<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'titulo-eleitor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'numero'); ?>
		<?php $this->widget('CMaskedTextField', array(
                                            'model'=>$model,
                                            'attribute'=>'numero',
                                            'mask'=>'99999',
                                            'htmlOptions'=>array('size'=>9),
                            ));?>
		<?php echo $form->error($model,'numero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zona'); ?>
		<?php echo $form->textField($model,'zona',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'zona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'secao'); ?>
		<?php echo $form->textField($model,'secao',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'secao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->