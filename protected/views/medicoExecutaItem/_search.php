<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'medico_cpf'); ?>
		<?php echo $form->textField($model,'medico_cpf',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_id'); ?>
		<?php echo $form->textField($model,'item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'medico_unidade_cnes'); ?>
		<?php echo $form->textField($model,'medico_unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantidade'); ?>
		<?php echo $form->textField($model,'quantidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'competencia'); ?>
		<?php echo $form->textField($model,'competencia'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->