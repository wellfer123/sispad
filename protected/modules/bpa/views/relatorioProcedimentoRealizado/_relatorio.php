<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'relatorio-procedimento-realizado-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> têm preenchimento garantido.</p>

	<?php echo $form->errorSummary($model); ?>
        <table>
            <tbody>
                
                <tr>
                    <td >
                        <?php echo $form->labelEx($model,'relatorio'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'relatorio', 
                                                            $relatorios,
                                                            array('empty'=>'Escolha o relatório'))?>
                        <?php echo $form->error($model,'relatorio'); ?>
                    </td>
                    
                    
                    <td>
                        <?php echo $form->labelEx($model,'competencia'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'competencia', 
                                                            $competencias,
                                                            array('empty'=>'Competências'))?>
                        <?php echo $form->error($model,'competencia'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'competencia_movimento'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'competencia_movimento', 
                                                            $competencias_movimento,
                                                            array('empty'=>'Competência Movimento'))?>
                        <?php echo $form->error($model,'competencia_movimento'); ?>
                    </td>
               </tr>
                <tr>
                    <td colspan="3">
                        <?php echo $form->labelEx($model,'unidade_cnes'); ?>
                         <?php //echo $form->labelEx($model,'unidade_cnes'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                            'model'=>$model,
                                            'attribute'=>'unidade_cnes', //the FK field (from CJuiInputWidget)
                                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                                            'sourceUrl'=>Yii::app()->createUrl('Unidade/findUnidadesCnes'),
                                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                            'showFKField'=>false,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>6,
                                           // 'relName'=>'servidor', // the relation name defined above
                                            'displayAttr'=>'nome',  // attribute or pseudo-attribute to display
                                            // length of the AutoComplete/display field, defaults to 50
                                            'autoCompleteLength'=>110,
                                            // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                            // also be defined.  read the code and docs for all options
                                            'options'=>array(
                                                // number of characters that must be typed before
                                                    // autoCompleter returns a value, defaults to 2
                                                'minLength'=>3,
                                                ),
                                        ));?>
                        <?php //echo $form->textField($model,'unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'unidade_cnes'); ?>
                    </td>
                 </tr>
                 <tr>
                     <td colspan="3">
                        <?php echo $form->labelEx($model,'profissional_cns'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                            'model'=>$model,
                                            'attribute'=>'profissional_cns', //the FK field (from CJuiInputWidget)
                                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                                            'sourceUrl'=>Yii::app()->createUrl('Servidor/findServidoresCns'),
                                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                            'showFKField'=>false,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>15,
                                           // 'relName'=>'servidor', // the relation name defined above
                                            'displayAttr'=>'CnsNome',  // attribute or pseudo-attribute to display
                                            // length of the AutoComplete/display field, defaults to 50
                                            'autoCompleteLength'=>110,
                                            // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                            // also be defined.  read the code and docs for all options
                                            'options'=>array(
                                                // number of characters that must be typed before
                                                    // autoCompleter returns a value, defaults to 2
                                                'minLength'=>3,
                                                ),
                                        ));?>
                        <?php echo $form->error($model,'profissional_cns'); ?>
                    </td>
                 </tr>
               
              <tr>
                  <td colspan="3">
                       <?php echo $form->labelEx($model,'profissional_cbo'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                            'model'=>$model,
                                            'attribute'=>'profissional_cbo', //the FK field (from CJuiInputWidget)
                                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                                            'sourceUrl'=>Yii::app()->createUrl('Profissao/findProfissoesCbo'),
                                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                            'showFKField'=>false,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>6,
                                           // 'relName'=>'servidor', // the relation name defined above
                                            'displayAttr'=>'nome',  // attribute or pseudo-attribute to display
                                            // length of the AutoComplete/display field, defaults to 50
                                            'autoCompleteLength'=>110,
                                            // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                            // also be defined.  read the code and docs for all options
                                            'options'=>array(
                                                // number of characters that must be typed before
                                                    // autoCompleter returns a value, defaults to 2
                                                'minLength'=>4,
                                                ),
                                        ));?>
                        <?php echo $form->error($model,'profissional_cbo'); ?>
                    </td>
                    
               </tr>
               
               <tr>
                   <td colspan="3">
                        <?php echo $form->labelEx($model,'procedimento'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                            'model'=>$model,
                                            'attribute'=>'procedimento', //the FK field (from CJuiInputWidget)
                                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                                            'sourceUrl'=>Yii::app()->createUrl('bpa/ProcedimentoAmbulatorial/findProcedimentos'),
                                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                            'showFKField'=>false,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>6,
                                           // 'relName'=>'servidor', // the relation name defined above
                                            'displayAttr'=>'nome',  // attribute or pseudo-attribute to display
                                            // length of the AutoComplete/display field, defaults to 50
                                            'autoCompleteLength'=>110,
                                            // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                            // also be defined.  read the code and docs for all options
                                            'options'=>array(
                                                // number of characters that must be typed before
                                                    // autoCompleter returns a value, defaults to 2
                                                'minLength'=>3,
                                                ),
                                        ));?>
                        <?php //echo $form->textField($model,'procedimento',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'procedimento'); ?>  
                   </td>
               </tr>
               
               <tr>
                   <td colspan="3">
                        <?php echo $form->labelEx($model,'paciente_cns'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                            'model'=>$model,
                                            'attribute'=>'paciente_cns', //the FK field (from CJuiInputWidget)
                                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                                            'sourceUrl'=>Yii::app()->createUrl('/bpa/Paciente/findCns'),
                                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                            'showFKField'=>false,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>15,
                                           // 'relName'=>'servidor', // the relation name defined above
                                            'displayAttr'=>'CnsNome',  // attribute or pseudo-attribute to display
                                            // length of the AutoComplete/display field, defaults to 50
                                            'autoCompleteLength'=>110,
                                            // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                            // also be defined.  read the code and docs for all options
                                            'options'=>array(
                                                // number of characters that must be typed before
                                                    // autoCompleter returns a value, defaults to 2
                                                'minLength'=>3,
                                                ),
                                        ));?>
                        <?php echo $form->error($model,'paciente_cns'); ?>
               </tr>
               <tr>
                  
                    <td colspan="2">
                        <?php echo $form->labelEx($model,'paciente_cidade'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                            'model'=>$model,
                                            'attribute'=>'paciente_cidade', //the FK field (from CJuiInputWidget)
                                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                                            'sourceUrl'=>Yii::app()->createUrl('Cidade/findCidadesIbge'),
                                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                            'showFKField'=>false,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>11,
                                           // 'relName'=>'servidor', // the relation name defined above
                                            'displayAttr'=>'nome',  // attribute or pseudo-attribute to display
                                            // length of the AutoComplete/display field, defaults to 50
                                            'autoCompleteLength'=>80,
                                            // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                            // also be defined.  read the code and docs for all options
                                            'options'=>array(
                                                // number of characters that must be typed before
                                                    // autoCompleter returns a value, defaults to 2
                                                'minLength'=>6,
                                                ),
                                        ));?>
                        <?php echo $form->error($model,'paciente_cidade'); ?>
                     </td>
                     
                     <td colspan="1">
                       <?php echo $form->labelEx($model,'data_atendimento'); ?>
                       
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'name'=>'Data',
                                'language'=>'pt',
                                'model'=>$model,
                                'attribute'=>'data_atendimento',
                                ))?>
                        <?php echo $form->error($model,'data_atendimento'); ?>
                    </td>
                    
               </tr>
               
               <tr>
                    <td colspan="3">
                         <?php echo $form->labelEx($model,'cid'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                            'model'=>$model,
                                            'attribute'=>'cid', //the FK field (from CJuiInputWidget)
                                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                                            'sourceUrl'=>Yii::app()->createUrl('bpa/Cid/findCids'),
                                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                            'showFKField'=>false,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>6,
                                           // 'relName'=>'servidor', // the relation name defined above
                                            'displayAttr'=>'nome',  // attribute or pseudo-attribute to display
                                            // length of the AutoComplete/display field, defaults to 50
                                            'autoCompleteLength'=>110,
                                            // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                            // also be defined.  read the code and docs for all options
                                            'options'=>array(
                                                // number of characters that must be typed before
                                                    // autoCompleter returns a value, defaults to 2
                                                'minLength'=>2,
                                                ),
                                        ));?>
                        <?php echo $form->error($model,'cid'); ?>
                    </td>
                    <td>
                      
                    </td>
                    
               </tr>
             
           </tbody>
       </table>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Executar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->