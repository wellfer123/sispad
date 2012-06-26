
<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'agenteSaudeExecutaMeta-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

        <div class ="row">
                            <?php echo $form->labelEx($model,'competencia'); ?>
                            <?php echo $form->dropDownList($model,'competencia',CHtml::listData($model->searchCompetencias(),'competencia','competencia'));?>
                            <?php echo $form->error($model,'competencia'); ?>
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('OK'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->