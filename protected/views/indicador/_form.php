
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'indicador-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,


)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
                <?php echo $form->error($model,'nome'); ?>
        </div>
         <div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao'); ?>
                <?php echo $form->error($model,'descricao'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'profissao_codigo'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'profissao_codigo', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Profissao/findProfissoes'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'profissao', // the relation name defined above
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
                        <?php echo $form->error($model,'profissao_codigo'); ?>
        </div>        
        <div class="row">
		<?php echo $form->labelEx($model,'afericao'); ?>
		<?php echo $form->textField($model,'afericao'); ?>
                <?php echo $form->error($model,'afericao'); ?>
        </div>
        <div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
