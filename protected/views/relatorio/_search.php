<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'conteudo'); ?>
		<?php //echo $form->textArea($model,'conteudo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_envio'); ?>
		<?php echo $form->textField($model,'data_envio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_trabalho'); ?>
		<?php echo $form->textField($model,'data_trabalho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->