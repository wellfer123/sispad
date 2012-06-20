<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'medico-executa-meta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> têm preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>

	
        
        <table>
            <tbody>
                <tr>
                    <td colspan="3">
                    <?php echo $form->labelEx($model,'meta_id'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model, 
                                    'attribute'=>'meta_id', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Meta/findMetas'), 
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>10,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'meta', // the relation name defined above
                                    'displayAttr'=>'NomeDescricao',  // attribute or pseudo-attribute to display
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
                        <?php echo $form->error($model,'meta_id'); ?>
                    
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                       <?php echo $form->labelEx($model,'medico_cpf'); ?>
                       
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attributes'=>array('unidade_cnes'),
                                    'attribute'=>'medico_cpf', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Servidor/findMedicos'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>true,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'relName'=>'medico', // the relation name defined above
                                    'displayAttr'=>'ServidorUnidade',  // attribute or pseudo-attribute to display
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
                        <?php echo $form->error($model,'medico_cpf'); ?>
                    </td>
                </tr>
                 <tr>
                     </td>
                        <td>
                             <?php echo $form->labelEx($model,'competencia'); ?>
                            <?php echo Chtml::activeDropDownList($model, 'competencia', 
                                                    CHtml::listData(Competencia::model()->findAll(), 'mes_ano', 'mes_ano'),array('size'=>1,'maxlength'=>6)) ?>
                            <?php echo $form->error($model,'estado_civil'); ?> 
                        </td>
                </tr>
                
                 
            </tbody>
        </table>
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->