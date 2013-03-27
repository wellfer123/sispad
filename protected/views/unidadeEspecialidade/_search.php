<?php
/* @var $this UnidadeEspecialidadeController */
/* @var $model UnidadeEspecialidade */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'unidade_cnes'); ?>
		<?php echo $form->textField($model,'unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'grupo_codigo'); ?>
		<?php echo $form->textField($model,'grupo_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profissao_codigo'); ?>
		<?php echo $form->textField($model,'profissao_codigo',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->