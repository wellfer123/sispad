<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_admissao'); ?>
		<?php echo $form->textField($model,'data_admissao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pis'); ?>
		<?php echo $form->textField($model,'pis',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_horaria'); ?>
		<?php echo $form->textField($model,'carga_horaria'); ?>
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
		<?php echo $form->label($model,'salario'); ?>
		<?php echo $form->textField($model,'salario',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'conselho_classe'); ?>
		<?php echo $form->textField($model,'conselho_classe',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_afastamento'); ?>
		<?php echo $form->textField($model,'data_afastamento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_retorno'); ?>
		<?php echo $form->textField($model,'data_retorno'); ?>
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