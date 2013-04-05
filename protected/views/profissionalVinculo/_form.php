<?php
/* @var $this ProfissionalVinculoController */
/* @var $model ProfissionalVinculo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profissional-vinculo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">
		<?php //echo $form->labelEx($model,'cpf'); ?>
		<?php //echo $form->textField($model,'cpf',array('size'=>11,'maxlength'=>11)); ?>
		<?php //echo $form->error($model,'cpf'); ?>
	</div>-->
        <div class="row">
		<?php echo CHtml::activeLabel($model, 'unidade_cnes'); ?>
                <?php echo CHtml::activeDropDownList($model, 'unidade_cnes', CHtml::listData( $unidades,'cnes','nome')); ?>
                <?php echo CHtml::error($model, 'unidade_cnes') ; ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'cpf'); ?>
                <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'cpf', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Servidor/findServidores'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
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
                                        'minLength'=>4,
                                        ),
                                ));?>
		<?php echo $form->error($model,'cpf'); ?>
	</div>
         <div class="row">
		<?php echo $form->labelEx($model,'codigo_profissao'); ?>
                <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'codigo_profissao', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Profissao/findProfissoesCboSaude'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'relName'=>'profissao', // the relation name defined above
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
		<?php echo $form->error($model,'codigo_profissao'); ?>
	</div>
<!--	<div class="row">
		<?php //echo $form->labelEx($model,'codigo_profissao'); ?>
		<?php //echo $form->textField($model,'codigo_profissao',array('size'=>6,'maxlength'=>6)); ?>
		<?php //echo $form->error($model,'codigo_profissao'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->