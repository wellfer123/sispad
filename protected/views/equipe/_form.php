<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipe-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'codigo_segmento'); ?>
		<?php echo $form->textField($model,'codigo_segmento'); ?>
		<?php echo $form->error($model,'codigo_segmento'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo'); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'codigo_area'); ?>
		<?php echo $form->textField($model,'codigo_area'); ?>
		<?php echo $form->error($model,'codigo_area'); ?>
	</div>

	<div class="row">
		  <?php echo $form->labelEx($model,'unidade_cnes'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'unidade_cnes', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Unidade/findUnidades'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>10,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'unidade', // the relation name defined above
                                    'displayAttr'=>'NomeDescricao',  // attribute or pseudo-attribute to display
                                    // length of the AutoComplete/display field, defaults to 50
                                    'autoCompleteLength'=>60,
                                     // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                     // also be defined.  read the code and docs for all options
                                    'options'=>array(
                                        // number of characters that must be typed before
                                            // autoCompleter returns a value, defaults to 2
                                        'minLength'=>6,
                                        ),
                                ));?>
                        <?php echo $form->error($model,'unidade_cnes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_microarea'); ?>
		<?php echo $form->textField($model,'codigo_microarea'); ?>
		<?php echo $form->error($model,'codigo_microarea'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->