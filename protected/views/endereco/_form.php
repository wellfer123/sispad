<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'endereco-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> têm preenchimento obrigatório.</p>
        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>
        <table>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'logradouro'); ?>
                        <?php echo $form->textField($model,'logradouro',array('size'=>30,'maxlength'=>30)); ?>
                        <?php echo $form->error($model,'logradouro'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'numero'); ?>
                        <?php echo $form->textField($model,'numero'); ?>
                        <?php echo $form->error($model,'numero'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'complemento'); ?>
                        <?php echo $form->textField($model,'complemento',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'complemento'); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'bairro'); ?>
                        <?php echo $form->textField($model,'bairro',array('size'=>30,'maxlength'=>30)); ?>
                        <?php echo $form->error($model,'bairro'); ?>
                    </td>
                    
                    <td colspan="2">
                        <?php echo $form->labelEx($model,'cidade_id'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'cidade_id', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Cidade/findCidades'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'cidades', // the relation name defined above
                                    'displayAttr'=>'NomeEstado',  // attribute or pseudo-attribute to display
                                    // length of the AutoComplete/display field, defaults to 50
                                    'autoCompleteLength'=>60,
                                     // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                     // also be defined.  read the code and docs for all options
                                    'options'=>array(
                                        // number of characters that must be typed before
                                            // autoCompleter returns a value, defaults to 2
                                        'minLength'=>4,
                                        ),
                                ));?>
                        <?php echo $form->error($model,'cidade_id'); ?>
                    </td>
                    
                </tr>
                
                <tr>
                    
                    <td>
                        <?php echo $form->labelEx($model,'telefone'); ?>
                        <?php echo $form->textField($model,'telefone',array('size'=>11,'maxlength'=>11)); ?>
                        <?php echo $form->error($model,'telefone'); ?>
                    </td>
                    
                    <td colspan="2">
                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>30)); ?>
                        <?php echo $form->error($model,'email'); ?>
                    </td>
                </tr>
            </tbody>
        </table>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->