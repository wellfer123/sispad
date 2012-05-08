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

      </table>
	<div class="row buttons">
		<?php echo CHtml::submitButton('OK'); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->