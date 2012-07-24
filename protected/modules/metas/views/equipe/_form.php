<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'equipe-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> têm preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>
         <table>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'codigo_segmento'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'codigo_segmento', Equipe::$tipo_segmentos, array('maxlength'=>2)) ?>
                        <?php echo $form->error($model,'codigo_segmento'); ?> 
                    </td>
                </tr>
                 <tr>
                    <td>
                        <?php echo $form->labelEx($model,'tipo'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'tipo', Equipe::$tipos_equipe, array('maxlength'=>2)) ?>
                        <?php echo $form->error($model,'tipo'); ?> 
                    </td>
                </tr>
                 <tr>
                    <td>
                        <?php echo $form->labelEx($model,'codigo_area'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'codigo_area', Equipe::getListCodigoArea(), array('maxlength'=>2)) ?>
                        <?php echo $form->error($model,'codigo_area'); ?>
                    </td>
                </tr>
                 <tr>
                    <td>
                         <?php echo $form->labelEx($model,'unidade_cnes'); ?>
                         <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'unidade_cnes', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Unidade/findUnidades'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>10,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'unidade', // the relation name defined above
                                    'displayAttr'=>'NomeDescricao',  // attribute or pseudo-attribute to display
                                    // length of the AutoComplete/display field, defaults to 50
                                    'autoCompleteLength'=>60,
                                     // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                     // also be defined.  read the code and docs for all options
                                    'options'=>array(
                                        // number of characters that must be typed before
                                            // autoCompleter returns a value, defaults to 2
                                        'minLength'=>3,
                                        ),
                                ));?>
                          <?php echo $form->error($model,'unidade_cnes'); ?>
                    </td>
                </tr>
            </tbody>
        </table> 
       	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->