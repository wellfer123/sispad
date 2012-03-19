<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'total-frequencia-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mes'); ?>
		<?php echo $form->textField($model,'mes'); ?>
		<?php echo $form->error($model,'mes'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'ano'); ?>
		<?php echo $form->textField($model,'ano'); ?>
		<?php echo $form->error($model,'ano'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantidade'); ?>
		<?php echo $form->textField($model,'quantidade'); ?>
		<?php echo $form->error($model,'quantidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
                <?php echo CHtml::activedropDownList($model, 
                                               'servidor_cpf',
                                               CHtml::listData(Servidor::model()->findAll(), 'cpf', 'nome'),
                                                               array('empty'=>'Escolha o funcionário')) ;?>
		<?php echo $form->error($model,'servidor_cpf'); ?>
            
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->