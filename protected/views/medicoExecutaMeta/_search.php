<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'medico_cpf'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model,'meta_id'); ?>
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
	</div>

	

	<div class="row">
		<?php echo $form->label($model,'data_inicio'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                //'name'=>'data_admisao',
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
                                                'attribute'=>'data_inicio'))?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_fim'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                //'name'=>'data_afastamento',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'options'=>array(
                                                    'changeMonth'=>'true', 
                                                    'changeYear'=>'true',   
                                                    'yearRange' => '-99:+1', 
                                                    'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                                                    'showOn'=>'button',
                                                    'buttonText'=>Yii::t('ui','Selecione a data'), 
                                                    'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png', 
                                                    'buttonImageOnly'=>true,
                                                ),
                                                'attribute'=>'data_fim',
                                                'htmlOptions'=>array()))?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->