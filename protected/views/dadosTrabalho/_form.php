<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'dados-trabalho-form',
        //'uniform'=>array('theme'=>'default'),
	'enableClientValidation'=>true,
)); ?>

        <p class="note">Todos os campos com <span class="required">*</span> são de preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>

        <table>
            <tbody>
                <tr>
                    <td colspan="2">
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
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'conselho_classe'); ?>
                        <?php echo $form->textField($model,'conselho_classe',array('size'=>20,'maxlength'=>20,'style'=>'text-transform:uppercase')); ?>
                        <?php echo $form->error($model,'conselho_classe'); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'salario'); ?>
                        <?php echo $form->textField($model,'salario',array('size'=>7,'maxlength'=>7)); ?>
                        <?php echo $form->error($model,'salario'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'carga_horaria'); ?>
                        <?php echo $form->textField($model,'carga_horaria'); ?>
                        <?php echo $form->error($model,'carga_horaria'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'pis'); ?>
                        <?php echo $form->textField($model,'pis',array('size'=>11,'maxlength'=>11)); ?>
                        <?php echo $form->error($model,'pis'); ?>
                    </td>
                </tr>
                
                
                <tr>
                    
                    <td>
                        <?php echo $form->labelEx($model,'turno'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'turno', DadosTrabalho::$TIPOS_TURNOS, array('maxlength'=>1)) ?>
                        <?php echo $form->error($model,'turno'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'situacao_funcional'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'situacao_funcional', DadosTrabalho::$SITUACOES_FUNCIONAIS, array('maxlength'=>2)) ?>
                        <?php echo $form->error($model,'situacao_funcional'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'vinculo'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'vinculo', DadosTrabalho::$TIPOS_VINCULOS, array('maxlength'=>1)) ?>
                        <?php echo $form->error($model,'vinculo'); ?>
                    </td>
                </tr>
                
                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'data_admissao'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'name'=>'data_admisao',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_admissao',
                                                'htmlOptions'=>array('disabled'=>!$model->isNewRecord)))?>
                        <?php echo $form->error($model,'data_admissao'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'data_afastamento'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'name'=>'data_afastamento',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_afastamento',
                                                'htmlOptions'=>array()))?>
                        <?php echo $form->error($model,'data_afastamento'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'data_retorno'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'name'=>'data_retorno',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_retorno',
                                                'htmlOptions'=>array()))?>
                        <?php echo $form->error($model,'data_retorno'); ?>
                    </td>
                </tr>
                
            </tbody>
        </table>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->