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
                        
                        <?php echo $form->radioButtonList($model,'relatorio',  
                                                          RelatorioProcedimentoRealizado::$TIPOS_RELATORIOS,array('separator'=>' ')); ?>
                        <?php echo $form->error($model,'relatorio'); ?>
                    </td>
               </tr>
               <tr>
                   <td colspan="3" ><hr></td>
               </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'unidade_cnes'); ?>
                        <?php echo $form->textField($model,'unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'unidade_cnes'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'profissional_cns'); ?>
                        <?php echo $form->textField($model,'profissional_cns',array('size'=>15,'maxlength'=>15)); ?>
                        <?php echo $form->error($model,'profissional_cns'); ?>
                    </td>

                    <td>
                        <?php //echo $form->labelEx($model,'profissional_cbo'); ?>
                        <?php //echo $form->textField($model,'profissional_cbo',array('size'=>6,'maxlength'=>6)); ?>
                        <?php //echo $form->error($model,'profissional_cbo'); ?>
                        <?php echo $form->labelEx($model,'competencia_movimento'); ?>
                        <?php echo $form->textField($model,'competencia_movimento',array('size'=>6,'maxlength'=>6)); ?>
                        <?php echo $form->error($model,'competencia_movimento'); ?>

                        
                        
                    </td>
               </tr>
               
              <tr>
                    <td>
                        <?php echo $form->labelEx($model,'competencia'); ?>
                        <?php echo $form->textField($model,'competencia',array('size'=>6,'maxlength'=>6)); ?>
                        <?php echo $form->error($model,'competencia'); ?>
                    </td>

                    <td colspan="2">
                       <?php echo $form->labelEx($model,'profissional_cbo'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                            'model'=>$model,
                                            'attribute'=>'profissional_cbo', //the FK field (from CJuiInputWidget)
                                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                                            'sourceUrl'=>Yii::app()->createUrl('Profissao/findProfissoesCbo'),
                                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                            'showFKField'=>true,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>6,
                                           // 'relName'=>'servidor', // the relation name defined above
                                            'displayAttr'=>'nome',  // attribute or pseudo-attribute to display
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
                        <?php echo $form->error($model,'profissional_cbo'); ?>
                    </td>
                    <td></td>
               </tr>
               <tr>
                   <td colspan="3" ><hr></td>
               </tr>
               <tr>
                    <td>
                        <?php echo $form->labelEx($model,'paciente_cns'); ?>
                        <?php echo $form->textField($model,'paciente_cns',array('size'=>15,'maxlength'=>15)); ?>
                        <?php echo $form->error($model,'paciente_cns'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'paciente_sexo'); ?>
                        <?php echo $form->textField($model,'paciente_sexo',array('size'=>1,'maxlength'=>1)); ?>
                        <?php echo $form->error($model,'paciente_sexo'); ?>
                    </td>

                    <td>
                         <?php echo $form->labelEx($model,'paciente_idade'); ?>
                        <?php echo $form->textField($model,'paciente_idade',array('size'=>6,'maxlength'=>6)); ?>
                        <?php echo $form->error($model,'paciente_idade'); ?>
                       
                    </td>
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
                                            'showFKField'=>true,
                                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                                            'FKFieldSize'=>11,
                                           // 'relName'=>'servidor', // the relation name defined above
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
                        <?php echo $form->error($model,'paciente_cidade'); ?>
                    </td>
                    </td>

                    <td>
                        <?php //echo $form->labelEx($model,'paciente_cidade'); ?>
                        <?php //echo $form->textField($model,'paciente_cidade',array('size'=>6,'maxlength'=>6)); ?>
                        <?php //echo $form->error($model,'paciente_cidade'); ?>
                        <?php echo $form->labelEx($model,'procedimento'); ?>
                        <?php echo $form->textField($model,'procedimento',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'procedimento'); ?>
                        
                     
                    </td>
               </tr>
               <tr>
                    <td>
                        <?php echo $form->labelEx($model,'cnpj'); ?>
                        <?php echo $form->textField($model,'cnpj',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'cnpj'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'data_atendimento'); ?>
                       
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'name'=>'Data',
                                'language'=>'pt',
                                'model'=>$model,
                                'attribute'=>'data_atendimento',
                                ))?>
                        <?php echo $form->error($model,'data_atendimento'); ?>
                    </td>

                    <td>
                        <?php echo $form->labelEx($model,'cid'); ?>
                        <?php echo $form->textField($model,'cid',array('size'=>6,'maxlength'=>6)); ?>
                        <?php echo $form->error($model,'cid'); ?>
                    </td>
               </tr>
             
           </tbody>
       </table>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Executar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->