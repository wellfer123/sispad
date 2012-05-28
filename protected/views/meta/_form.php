<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'meta-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,


)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
                <?php echo $form->error($model,'nome'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'periodicidade_id'); ?>
		<?php echo $form->dropDownList($model,'periodicidade_id',CHtml::listData(Periodicidade::model()->findAll(),'id','nome'));?>
                <?php echo $form->error($model,'periodicidade_id'); ?>
        </div>
         <div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor'); ?>
                <?php echo $form->error($model,'valor'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'percentagem'); ?>
		<?php echo $form->textField($model,'percentagem').'%'; ?>
                <?php echo $form->error($model,'percentagem'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
                <?php echo $form->dropDownList($model,'tipo',array("IT"=>'Itens',"PR"=>'Procedimento'));?>
		
                <?php echo $form->error($model,'tipo'); ?>
        </div>
         <div class="row">
		<?php //echo $form->labelEx($model,'item_id'); ?>
		<?php //echo $form->dropDownList($model,'item_id',CHtml::listData(Item::model()->findAll(),'id','nome'));?>
                <?php //echo $form->error($model,'item_id'); ?>
        </div>
        <div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>


</div>