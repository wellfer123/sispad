<?php Yii::import('application.services.FormataData');?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'falta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="row row_line">
		<?php echo $form->labelEx($model,'dia'); ?>
		<?php echo $form->dropDownList($model,'dia',  FormataData::geraArrayDiasDoMes($model->mes, $model->ano));?>
		<?php echo $form->error($model,'dia'); ?>
	</div>
	<div class="row row_line">
		<?php echo $form->labelEx($model,'motivo_id'); ?>
		<?php echo $form->dropDownList($model,'motivo_id',CHtml::listData(Motivo::model()->findAll(),'id','descricao'));?>
		<?php echo $form->error($model,'motivo_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->