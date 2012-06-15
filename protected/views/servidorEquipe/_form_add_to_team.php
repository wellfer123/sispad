<div class="form">

<?php
$ourscript = "$(document).ready(function(){
    $('#microarea').hide();
    $('#ServidorEquipe_funcao').change(function(){
        var funcao = $('#ServidorEquipe_funcao').val();
        if(funcao=='AgenteSaude')
        $('#microarea').show('slow');
        else
        $('#microarea').hide('slow');
});



});";
    Yii::app()->clientScript->registerScript('helloscript',$ourscript,CClientScript::POS_READY);
?>


<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'servidorEquipe-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Campos com <span class="required">*</span> sao obrigatórios</p>

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
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'funcao'); ?>
                        <?php echo $form->dropDownList($model,'funcao',array('Odontologo'=>'Odontólogo','Medico'=>'Médico',
                 'Enfermeiro'=>'Enfermeiro','AgenteSaude'=>'Agente de Saúde'));?>
                    </td>
                </tr>
                <tr>
                    <td id="microarea">
                        <?php echo CHtml::label('Microarea',false); ?>
                        <?php echo CHtml::textField('codigo_microarea');?>
                    </td>
                </tr>
            </tbody>
        </table>    
        <div class="row buttons">
		<?php echo CHtml::submitButton('OK'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->