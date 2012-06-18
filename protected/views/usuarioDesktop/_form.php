<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'usuario-desktop-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> são de preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>

<table>
    <tbody>
           <tr>
             <td>
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
                <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'servidor_cpf', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Servidor/findServidoresUsuarios'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>true,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'relName'=>'servidor', // the relation name defined above
                                    'displayAttr'=>'nome',  // attribute or pseudo-attribute to display
                                    // length of the AutoComplete/display field, defaults to 50
                                    'autoCompleteLength'=>60,
                                    'htmlOptions'=>array('disabled'=>!$model->isNewRecord),
                                     // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                     // also be defined.  read the code and docs for all options
                                    'options'=>array(
                                        // number of characters that must be typed before
                                            // autoCompleter returns a value, defaults to 2
                                        'minLength'=>6,
                                        ),
                                ));?>
		<?php echo $form->error($model,'servidor_cpf'); ?>
             </td>
           </tr>

	<tr>
            <td>
		<?php echo $form->labelEx($model,'serial_aplicacao'); ?>
		<?php echo $form->textField($model,'serial_aplicacao',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'serial_aplicacao'); ?>
            </td>
        </tr>
        
    <tr>
       <td>
                <div class="row buttons">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
                </div>
       </td>
     </tr>
</tbody>
</table>
        
<?php $this->endWidget(); ?>

</div><!-- form -->