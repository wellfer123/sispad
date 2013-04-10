<?php
/* @var $this UnidadeGrupoController */
/* @var $model UnidadeGrupo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unidade-grupo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'unidade_cnes'); ?>
                <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'unidade_cnes', 
                                    'sourceUrl'=>Yii::app()->createUrl('Unidade/findUnidades'),
                                    'showFKField'=>false,
                                    'FKFieldSize'=>11,
                                    'relName'=>'unidade', 
                                    'displayAttr'=>'nome',  
                                    'autoCompleteLength'=>60,
                                    'options'=>array(
                                        'minLength'=>4,
                                        ),
                                ));?>
		<?php echo $form->error($model,'unidade_cnes'); ?>
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