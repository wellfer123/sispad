<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unidade-gestor-form',
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
		<?php echo $form->labelEx($model,'servidor_cpf'); ?>
                <?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'servidor_cpf', 
                                    'sourceUrl'=>Yii::app()->createUrl('Servidor/findServidores'),
                                    'showFKField'=>false,
                                    'FKFieldSize'=>11,
                                    'relName'=>'servidor', 
                                    'displayAttr'=>'nome',  
                                    'autoCompleteLength'=>60,
                                    'options'=>array(
                                        'minLength'=>4,
                                        ),
                                ));?>
		<?php echo $form->error($model,'servidor_cpf'); ?>
	</div>
        <div class="row">
            <?php echo $form->labelEx($model,'ativo'); ?>
            <?php echo $form->checkBox($model,'ativo',$model->isNewRecord ? array('disabled'=>true) : array('disabled'=>false)); ?>
            <?php echo $form->error($model,'ativo'); ?>
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->