<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'departamento-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> têm preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
                <?php if(!$model->isNewRecord){
                        echo $form->labelEx($model,'id',array('style'=>'display:inline; margin-right:5px; text-transform:uppercase')); 
                        echo CHtml::label($model->id, 'cod',array('style'=>'display:inline;text-transform:uppercase'));
                        
                } ?>
                </p>
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>40,'maxlength'=>40,'style'=>'text-transform:uppercase')); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textField($model,'descricao',array('size'=>60,'maxlength'=>100,'style'=>'text-transform:uppercase')); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

         <div class="row">
                <?php echo CHtml::activeLabel($model, 'unidade_cnes');?>
            
                <?php echo CHtml::activedropDownList($model, 
                                               'unidade_cnes',
                                               CHtml::listData(Unidade::model()->findAll(), 'cnes', 'nome'),
                                                               array('empty'=>'Escolha a unidade')) ;?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->