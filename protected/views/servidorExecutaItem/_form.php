<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'servidor-executa-item-form',
        //'uniform'=>array('theme'=>'default'),
	'enableClientValidation'=>true,
)); ?>

        <p class="note">Todos os campos com <span class="required">*</span> são de preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>

        <table>
            <tbody>
                <tr>
                    <td colspan="3">
                        <?php echo $form->labelEx($model,'servidor_cpf'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model, 
                                    'attribute'=>'servidor_cpf', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Servidor/findServidores'), 
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
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
                    </td>
                </tr>
                
                <td colspan="3">
                        <?php echo $form->labelEx($model,'item_id'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model, 
                                    'attribute'=>'item_id', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Item/findItens'), 
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'item', // the relation name defined above
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
                        <?php echo $form->error($model,'item_id'); ?>
                    </td>
                </tr>
                
                
                <tr>
                    
                    <td>
                        <?php echo $form->labelEx($model,'total'); ?>
                        <?php echo $form->textField($model,'total',array('size'=>10,'maxlength'=>11)); ?>
                        <?php echo $form->error($model,'total'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'data_inicio'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'name'=>'data_inicio',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_inicio',
                                                'htmlOptions'=>array('disabled'=>!$model->isNewRecord)))?>
                        <?php echo $form->error($model,'data_inicio'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'data_fim'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'name'=>'data_fim',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_fim',
                                                'htmlOptions'=>array()))?>
                        <?php echo $form->error($model,'data_fim'); ?>
                    </td>
                </tr>
                
            </tbody>
        </table>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->