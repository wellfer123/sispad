<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'mes_ano'); ?>
		<?php echo $form->textField($model,'mes_ano'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ativo'); ?>
		<?php echo $form->textField($model,'ativo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->