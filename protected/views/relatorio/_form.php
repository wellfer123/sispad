<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'relatorio-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
       
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
                        'attribute'=>'data_trabalho',
                        'htmlOptions'=>array('disabled'=>!$model->isNewRecord)))?>
		<?php echo $form->error($model,'data_trabalho'); ?>

	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf'); ?>
		<?php echo $form->error($model,'servidor_cpf'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'file_data'); ?>
                <?php echo $form->fileField($model,'file_data'); ?>
                <?php echo CHtml::link($model->file_name,array('display','id'=>$model->id));?>
		<?php echo $form->error($model,'file_data');?>
               
	</div>

	<div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->