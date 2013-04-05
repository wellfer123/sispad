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
		<?php echo $form->textField($model,'servidor_cpf',array('maxLength'=>11)); ?>
                <?php echo $form->error($model,'servidor_cpf'); ?>
        </div>
         <div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('maxLength'=>30)); ?>
                <?php echo $form->error($model,'username'); ?>
        </div>
         <div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
	        <?php echo $form->passwordField($model,'password',array('maxLength'=>32)); ?>
                <?php echo $form->error($model,'password'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('maxLength'=>255,'size'=>70)); ?>
                <?php echo $form->error($model,'email'); ?>
        </div>
         <div class="row">
                <?php echo $form->labelEx($model,'verifyCode'); ?>
                <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model,'verifyCode'); ?>
                </div>
                <div class="hint">Por favor, entre com as letras que são exibidas acima.
                <br/>Não existe diferença entre maiúscula ou minúscula.</div>
        </div>
        <div class="row buttons">
		<?php echo CHtml::submitButton('Registrar-se'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->