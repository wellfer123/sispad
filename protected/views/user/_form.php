<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Campos com <span class="required">*</span> sao obrigatórios</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
                <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'servidor_cpf', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Servidor/findServidores'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>true,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'relName'=>'servidor', // the relation name defined above
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
		<?php echo $form->error($model,'servidor_cpf'); ?>
	</div>
         <div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('maxLength'=>30)); ?>
                <?php echo $form->error($model,'username'); ?>
        </div>
         <div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
	        <?php echo $form->passwordField($model,'password',array('maxLength'=>32)); ?>
                <?php echo $form->error($model,'password'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('maxLength'=>30)); ?>
                <?php echo $form->error($model,'email'); ?>
        </div>
         <div class="row">
                <?php echo $form->labelEx($model,'verifyCode'); ?>
                <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model,'verifyCode'); ?>
                </div>
                <div class="hint">Por favor, entre com as letras que são exibidas acima.
                <br/>Não existe diferença entre maiúscula ou minúscula.</div>
        </div>
        <div class="row buttons">
		<?php echo CHtml::submitButton('Registrar'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->