<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'identidade-form',
	'enableClientValidation'=>true,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> têm preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>
        <table>
            <tbody>
                
                <tr>
                    <td colspan="3">
                        <?php echo $form->labelEx($model,'nome_mae'); ?>
                        <?php echo $form->textField($model,'nome_mae',array('size'=>60,'maxlength'=>60,'style'=>'text-transform:uppercase')); ?>
                        <?php echo $form->error($model,'nome_mae'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php echo $form->labelEx($model,'nome_pai'); ?>
                        <?php echo $form->textField($model,'nome_pai',array('size'=>60,'maxlength'=>60,'style'=>'text-transform:uppercase')); ?>
                        <?php echo $form->error($model,'nome_pai'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php 
                            echo    $form->labelEx($model,'numero'); 
                                    $this->widget('CMaskedTextField', array(
                                            'model'=>$model,
                                            'attribute'=>'numero',
                                            'mask'=>'9999?9999999999999999',
                                            'htmlOptions'=>array('disable'=>!$model->isNewRecord,'maxlength'=>20,'style'=>'text-transform:uppercase'),
                                    ));
                            echo    $form->error($model,'numero');
                        ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'orgao_expedidor'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'orgao_expedidor',
                                                                    Identidade::$ORGAO_EXPEDIDOR); ?>
                        <?php echo $form->error($model,'orgao_expedidor'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'uf'); ?>
                        <?php //vai ordenar os estados
                              $criteria =new CDbCriteria;
                              $criteria->order='estado_sigla ASC';
                              
                              echo CHtml::activeDropDownList($model, 'uf',
                                            CHtml::listData(Estados::model()->findAll($criteria), 'id', 'estado_nome')); ?>
                        <?php echo $form->error($model,'uf'); ?>
                    </td>
                    
                <tr>
                    <td colspan="2">
                       <?php echo $form->labelEx($model,'sexo'); ?>
                       <?php echo CHtml::activeDropDownList($model, 'sexo',
                                                                    Identidade::$SEXOS); ?>
                        <?php echo $form->error($model,'sexo'); ?> 
                    </td>
                    
                    <td>
                       <?php echo $form->labelEx($model,'data_nascimento'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'options'=>array(
                                                    'changeMonth'=>'true', 
                                                    'changeYear'=>'true',   
                                                    'yearRange' => '-99:+0', 
                                                    'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                                                    'showOn'=>'button',
                                                    'buttonText'=>Yii::t('ui','Selecione a data'), 
                                                    'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png', 
                                                    'buttonImageOnly'=>true,
                                                ),
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_nascimento',
                                                'htmlOptions'=>array()))?>
                        <?php echo $form->error($model,'data_nascimento'); ?>
                    </td>
                </tr> 
                        
                <tr>
                    <td colspan="3">
                        <?php echo $form->labelEx($model,'cidade_naturalidade_id'); ?>
                        <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model, 
                                    'attribute'=>'cidade_naturalidade_id', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Cidade/findCidades'), 
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'cidadeNaturalidade', // the relation name defined above
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
                        <?php echo $form->error($model,'cidade_naturalidade_id'); ?>
                    </td>
                </tr>
            </tbody>
        </table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->