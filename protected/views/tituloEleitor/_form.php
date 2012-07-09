<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'titulo-eleitor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> têm preenchimento obrigatório.</p>

	<?php echo $form->errorSummary($model); ?>
       
        <table>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'numero'); ?>
                        <?php $this->widget('CMaskedTextField', array(
                                            'model'=>$model,
                                            'attribute'=>'numero',
                                            'mask'=>'99999',
                                            'htmlOptions'=>array('size'=>9),
                            ));?>
                        <?php echo $form->error($model,'numero'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'zona'); ?>
                        <?php echo $form->textField($model,'zona',array('size'=>4,'maxlength'=>4)); ?>
                        <?php echo $form->error($model,'zona'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'secao'); ?>
                        <?php echo $form->textField($model,'secao',array('size'=>4,'maxlength'=>4)); ?>
                        <?php echo $form->error($model,'secao'); ?>
                    </td>
                <tr>
            </tbody>
        </table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->