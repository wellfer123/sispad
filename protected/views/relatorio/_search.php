<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'conteudo'); ?>
		<?php //echo $form->textArea($model,'conteudo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_envio'); ?>
		<?php echo $form->textField($model,'data_envio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_trabalho'); ?>
		<?php echo $form->textField($model,'data_trabalho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'servidor_cpf'); ?>
		<?php echo $form->textField($model,'servidor_cpf'); ?>
	</div>

        <div class="row">

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

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->