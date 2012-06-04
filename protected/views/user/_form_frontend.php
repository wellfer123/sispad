<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Campos com <span class="required">*</span> sao obrigatórios</p>

	<?php echo $form->errorSummary($model); ?>



	  <div class="row">
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf'); ?>
                <?php echo $form->error($model,'servidor_cpf'); ?>
        </div>
         <div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
                <?php echo $form->error($model,'username'); ?>
        </div>
         <div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
	        <?php echo $form->passwordField($model,'password'); ?>
                <?php echo $form->error($model,'password'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
                <?php echo $form->error($model,'email'); ?>
        </div>
         <div class="row">
                <?php echo $form->labelEx($model,'verifyCode'); ?>
                <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model,'verifyCode'); ?>
                </div>
                <div class="hint">Please enter the letters as they are shown in the image above.
                <br/>Letters are not case-sensitive.</div>
        </div>
        <div class="row buttons">
		<?php echo CHtml::submitButton('Cadastrar'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->