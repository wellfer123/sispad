<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'relatorio-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'data_trabalho'); ?>
		<?php //echo $form->textField($model,'data_envio',array('value'=>date('d/m/Y'),)); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'Data',
                        'language'=>'pt',
                        'model'=>$model,
                        'attribute'=>'data_trabalho',))?>
		<?php echo $form->error($model,'data_trabalho'); ?>

	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf'); ?>
		<?php echo $form->error($model,'servidor_cpf'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'conteudo'); ?>
		<?php echo $form->textArea($model,'conteudo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'conteudo'); ?>
	</div>

	<div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->