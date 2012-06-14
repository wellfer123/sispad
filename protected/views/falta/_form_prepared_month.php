<?php Yii::import('application.services.FormataData');?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'falta-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Campos com <span class="required">*</span> sao obrigatórios</p>

	<?php echo $form->errorSummary($model); ?>
        <table class ="table_form">

                <tr>
                    <td >
                            <?php echo $form->labelEx($model,'mes'); ?>
                            <?php echo $form->dropDownList($model,'mes',CHtml::listData(Meses::model()->findAll(),'id','nome'));?>
                            <?php echo $form->error($model,'mes'); ?></td>
                    <td >
                            <?php echo $form->labelEx($model,'ano'); ?>
                            <?php echo $form->dropDownList($model,'ano',  FormataData::geraArrayAnos(2012,2020));?>
                            <?php echo $form->error($model,'ano'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo CHtml::label('Unidade',false); ?>
                          <?php 
                                    $servidor = new Servidor;
                                    $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$servidor, 
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
                                        'minLength'=>6, 
                                        ),
                                ));?>
                        <?php echo $form->error($model,'unidade_cnes'); ?>
                    </td>
                </tr>

      </table>
	<div class="row buttons">
		<?php echo CHtml::submitButton('OK'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->