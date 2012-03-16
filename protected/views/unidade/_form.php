<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unidade-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'cnes'); ?>
                <?php $this->widget('CMaskedTextField', array(
                    'model'=>$model,
                    'attribute'=>'cnes',
                    'mask'=>'9999999999'
                )); ?>
		<?php echo $form->error($model,'cnes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textField($model,'descricao',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
        
        <div class="row">
                <?php echo CHtml::activeLabel($model, 'regional_id');?>
            
                <?php echo CHtml::activedropDownList($model, 
                                               'regional_id',
                                               CHtml::listData(Regionais::model()->findAll('regional_codigo_ibge=:id',array(':id'=>'2604')), 'id', 'regional_nome'),
                                                               array('empty'=>'Escolha uma Regional')) ;?>
		
	</div>
        
	<div class="row">
                <?php echo CHtml::activeLabel($model, 'cidade_id');?>
            
                <?php /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'model'=>$model,
                        'name'=>'teste',
                        'attribute'=>'cidade_id',
                        'source'=>$this->createUrl('cidade/SeachName?'),
                        'htmlOptions' => array(
                            'style' => 'height:15px;'
                             ),
                        'options'=>array(
                            'showAnim'=>'fold',
                            'minLength'=>'3',
                        ), ));*/ ?>
            
                
            
                <?php echo CHtml::activedropDownList($model, 
                                               'cidade_id',
                                               CHtml::listData(Cidades::model()->findAll('cidade_id_regional=:regional',array(':regional'=>'2604')), 'id', 'cidade_nome'),
                                                               array('empty'=>'Escolha uma cidade')) ;?>
		
	</div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->