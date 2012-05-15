<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'metaProcedimento-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
        

)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'procedimento_codigo'); ?>
               <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'procedimento_codigo', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Procedimento/findProcedimentos'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>true,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>10,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'procedimento', // the relation name defined above
                                    'displayAttr'=>'nome',  // attribute or pseudo-attribute to display
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
		<?php echo $form->error($model,'procedimento_codigo'); ?>
        <div class="row buttons">
		<?php  echo CHtml::submitButton('OK'); ?>
	</div>

<?php $this->endWidget(); ?>


</div>
</div>