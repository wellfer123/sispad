<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> têm preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>
        
        

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
                <?php   $this->widget('CMaskedTextField', array(
                        'model'=>$model,
                        'attribute'=>'servidor_cpf',
                        'mask'=>'99999999999',
                        'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                        ));
                ?> 
		<?php echo $form->error($model,'servidor_cpf'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar-se' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->