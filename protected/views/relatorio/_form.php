<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'relatorio-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
       
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'data_trabalho'); ?>
		<?php //echo $form->textField($model,'data_envio',array('value'=>date('d/m/Y'),)); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'Data',
                        'language'=>'pt',
                        'model'=>$model,
                        'attribute'=>'data_trabalho',
                        'htmlOptions'=>array('disabled'=>!$model->isNewRecord)))?>
		<?php echo $form->error($model,'data_trabalho'); ?>

	</div>

	

	<div class="row">
		<?php echo Chtml::label('Servidor', 'servidor'); ?>
                <?php 
                      $servidor=Servidor::model()->findByPk($model->servidor_cpf);
                      echo Chtml::textField('servidor_nome',$servidor->nome,array('disabled'=>true)) 
                
                 ?>
		<?php echo $form->error($model,'servidor_cpf'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model->arquivo,'file_data'); ?>
                <?php echo $form->fileField($model->arquivo,'file_data'); ?>
                <?php echo $form->error($model->arquivo,'file_data');?>
                <?php echo CHtml::link($model->arquivo->file_name,array('display','id'=>$model->id));?>
		

	</div>

	<div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->