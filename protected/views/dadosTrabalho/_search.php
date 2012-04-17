<div class="wide form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'turno'); ?>
		<?php echo $form->textField($model,'turno',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profissao'); ?>
		<?php echo $form->textField($model,'profissao',array('size'=>20,'maxlength'=>20)); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'situacao_funcional'); ?>
		<?php echo $form->textField($model,'situacao_funcional',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vinculo'); ?>
		<?php echo $form->textField($model,'vinculo',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->