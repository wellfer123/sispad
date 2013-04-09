<?php
/* @var $this UnidadeGestorController */
/* @var $model UnidadeGestor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'servidor_cpf'); ?>
		<?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'servidor_cpf', 
                                    'sourceUrl'=>Yii::app()->createUrl('Servidor/findServidores'),
                                    'showFKField'=>false,
                                    'FKFieldSize'=>11, 
                                    'displayAttr'=>'nome', 
                                    'autoCompleteLength'=>60,
                                    'options'=>array(
                                        'minLength'=>4,
                                        ),
                                )); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unidade_cnes'); ?>
		<?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attribute'=>'unidade_cnes', 
                                    'sourceUrl'=>Yii::app()->createUrl('Unidade/findUnidades'),
                                    'showFKField'=>false,
                                    'FKFieldSize'=>11, 
                                    'displayAttr'=>'nome',  
                                    'autoCompleteLength'=>60,
                                    'options'=>array(
                                        'minLength'=>4,
                                        ),
                                )); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'ativo'); ?>
                <?php echo Chtml::activeDropDownList($model, 'ativo', array(''=>'OPÇÃO','1'=>'ATIVO','0'=>'INATIVO')) ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->