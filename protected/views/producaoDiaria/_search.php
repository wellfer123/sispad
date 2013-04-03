<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'unidade'); ?>
                <?php echo Chtml::activeDropDownList($model, 'unidade', $unidades,array('empty'=>'Unidade')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'especialidade'); ?>
                <?php echo Chtml::activeDropDownList($model, 'especialidade', $especialidades,array('empty'=>'Especialidade')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->