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
                <?php echo Chtml::activeDropDownList($model, 'unidade', $unidades,array('empty'=>'Todas as unidades')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ano'); ?>
                <?php echo Chtml::activeDropDownList($model, 'ano', $anos); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->