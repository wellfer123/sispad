<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unidade-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'cnes'); ?>
		<?php echo $form->textField($model,'cnes',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cnes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textField($model,'descricao',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
                <?php echo CHtml::activeLabel($model, 'cidade_id');?>
                <?php echo CHtml::activedropDownList($model, 
                                               'cidade_id',
                                               CHtml::listData(Cidades::model()->findAll(), 'id', 'cidade_nome'),
                                                               array('empty'=>'Escolha uma cidade')) ;?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->