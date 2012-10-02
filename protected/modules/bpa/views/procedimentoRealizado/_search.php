<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'unidade'); ?>
		<?php echo $form->textField($model,'unidade',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'competencia'); ?>
		<?php echo $form->textField($model,'competencia',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profissional_cns'); ?>
		<?php echo $form->textField($model,'profissional_cns',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profissional_cbo'); ?>
		<?php echo $form->textField($model,'profissional_cbo',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'folha'); ?>
		<?php echo $form->textField($model,'folha',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sequencia'); ?>
		<?php echo $form->textField($model,'sequencia',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'procedimento'); ?>
		<?php echo $form->textField($model,'procedimento',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paciente_cns'); ?>
		<?php echo $form->textField($model,'paciente_cns',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_atendimento'); ?>
		<?php echo $form->textField($model,'data_atendimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cid'); ?>
		<?php echo $form->textField($model,'cid',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantidade'); ?>
		<?php echo $form->textField($model,'quantidade',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'caracter_atendimento'); ?>
		<?php echo $form->textField($model,'caracter_atendimento',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero_autorizacao'); ?>
		<?php echo $form->textField($model,'numero_autorizacao',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origem'); ?>
		<?php echo $form->textField($model,'origem',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'competencia_movimento'); ?>
		<?php echo $form->textField($model,'competencia_movimento',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'servico'); ?>
		<?php echo $form->textField($model,'servico',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'equipe'); ?>
		<?php echo $form->textField($model,'equipe',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'classificacao'); ?>
		<?php echo $form->textField($model,'classificacao',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_cadastro'); ?>
		<?php echo $form->textField($model,'data_cadastro'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->