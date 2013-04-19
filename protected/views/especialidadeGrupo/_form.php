<?php
/* @var $this EspecialidadeGrupoController */
/* @var $model EspecialidadeGrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'especialidade-grupo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'profissao_codigo'); ?>
                <?php
                        $this->widget('EJuiAutoCompleteFkField', array(
                            'model' => $model,
                            'attribute' => 'profissao_codigo', //the FK field (from CJuiInputWidget)
                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                            'sourceUrl' => Yii::app()->createUrl('Profissao/findProfissoesCboSaude'),
                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                            'showFKField' => false,
                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                            'FKFieldSize' => 6,
                            'relName'=>'especialidade', 
                            'htmlOptions' => array('style' => 'text-transform:uppercase'),
                            'displayAttr' => 'nome', // attribute or pseudo-attribute to display
                            // length of the AutoComplete/display field, defaults to 50
                            'autoCompleteLength' => 60,
                            'options' => array(
                                'minLength' => 4,
                            ),
                        ));
                        ?>
		<?php echo $form->error($model,'profissao_codigo'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'grupo_codigo'); ?>
                <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'grupo_codigo', 
                                    'sourceUrl'=>Yii::app()->createUrl('Grupo/findGrupos'),
                                    'showFKField'=>false,
                                    'FKFieldSize'=>3,
                                    'relName'=>'grupo', 
                                    'displayAttr'=>'nome',  
                                    'autoCompleteLength'=>60,
                                    'options'=>array(
                                        'minLength'=>4,
                                        ),
                                ));?>
		<?php echo $form->error($model,'grupo_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->