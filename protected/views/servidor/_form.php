<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'servidor-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> Todos os campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php 
                    //if($model->isNewRecord){
                        echo $form->labelEx($model,'cpf'); 
                        $this->widget('CMaskedTextField', array(
                        'model'=>$model,
                        'attribute'=>'cpf',
                        'mask'=>'99999999999',
                        'htmlOptions'=>array('size'=>11, 'disabled'=>!$model->isNewRecord,'style'=>'text-transform:uppercase'),
                        ));
                    echo $form->error($model,'cpf');
                    //}
                    ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>40,'maxlength'=>40,'style'=>'text-transform:uppercase')); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
                <?php 
                    //if($model->isNewRecord){
                        echo $form->labelEx($model,'matricula'); 
                        $this->widget('CMaskedTextField', array(
                        'model'=>$model,
                        'attribute'=>'matricula',
                        'mask'=>'9?99999999999999999999',
                        'htmlOptions'=>array('size'=>20, 'style'=>'text-transform:uppercase'),
                        ));
                    echo $form->error($model,'cpf');
                    //}
                    ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado_civil'); ?>
                <?php echo Chtml::activeDropDownList($model, 'estado_civil', 
                                                    Servidor::$ESTADOS_CIVIS,array('size'=>1,'maxlength'=>1)) ?>
		<?php echo $form->error($model,'estado_civil'); ?>
                
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unidade_cnes'); ?>
                <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model, 
                                    'attribute'=>'unidade_cnes', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Unidade/findUnidades'), 
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>true,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>10,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'unidade', // the relation name defined above
                                    'displayAttr'=>'NomeDescricao',  // attribute or pseudo-attribute to display
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
		<?php echo $form->error($model,'unidade_cnes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->