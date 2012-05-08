<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
        

)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
                <?php echo $form->error($model,'id'); ?>
        </div>

        <div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
                <?php echo $form->error($model,'nome'); ?>
        </div>
        <div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>


</div>