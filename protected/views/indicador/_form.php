<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'indicador-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,


)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
                <?php echo $form->error($model,'nome'); ?>
        </div>
         <div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao'); ?>
                <?php echo $form->error($model,'descricao'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'profissao_codigo'); ?>
		<?php echo $form->dropDownList($model,'profissao_codigo',CHtml::listData(Profissao::model()->findAll(),'codigo','nome'));?>
                <?php echo $form->error($model,'profissao_codigo'); ?>
        </div>        
        <div class="row">
		<?php echo $form->labelEx($model,'afericao'); ?>
		<?php echo $form->textField($model,'afericao'); ?>
                <?php echo $form->error($model,'afericao'); ?>
        </div>
        <div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>


</div>