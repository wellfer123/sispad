<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_complexidade'); ?>
		<?php echo $form->textField($model,'tipo_complexidade',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_sexo'); ?>
		<?php echo $form->textField($model,'tipo_sexo',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantidade_maxima_execucao'); ?>
		<?php echo $form->textField($model,'quantidade_maxima_execucao',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantidade_dias_permanencia'); ?>
		<?php echo $form->textField($model,'quantidade_dias_permanencia',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantidade_pontos'); ?>
		<?php echo $form->textField($model,'quantidade_pontos',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'validade_idade_minima'); ?>
		<?php echo $form->textField($model,'validade_idade_minima',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'validade_idade_maxima'); ?>
		<?php echo $form->textField($model,'validade_idade_maxima',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'validade_sh'); ?>
		<?php echo $form->textField($model,'validade_sh',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'validade_sa'); ?>
		<?php echo $form->textField($model,'validade_sa',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'validade_sp'); ?>
		<?php echo $form->textField($model,'validade_sp',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_financiamento'); ?>
		<?php echo $form->textField($model,'codigo_financiamento',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_rubrica'); ?>
		<?php echo $form->textField($model,'codigo_rubrica',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_competencia'); ?>
		<?php echo $form->textField($model,'data_competencia',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->