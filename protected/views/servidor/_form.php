<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'servidor-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> Todos os campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>
        <table>
            <tbody>
                <tr>
                    <td >
                        <?php echo $form->labelEx($model,'nome'); ?>
                        <?php echo $form->textField($model,'nome',array('size'=>60,'maxlength'=>40,'style'=>'text-transform:uppercase')); ?>
                        <?php echo $form->error($model,'nome'); ?>
                    </td>
                    
                    <td>
                        <?php 
                            echo $form->labelEx($model,'cpf'); 
                            $this->widget('CMaskedTextField', array(
                                            'model'=>$model,
                                            'attribute'=>'cpf',
                                            'mask'=>'99999999999',
                                            'htmlOptions'=>array('size'=>11, 'disabled'=>!$model->isNewRecord,'style'=>'text-transform:uppercase'),
                            ));
                        echo $form->error($model,'cpf');
                    ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php 
                            echo $form->labelEx($model,'matricula'); 
                                        $this->widget('CMaskedTextField', array(
                                        'model'=>$model,
                                        'attribute'=>'matricula',
                                        'mask'=>'9?99999999999999999999',
                                        'htmlOptions'=>array('size'=>20, 'style'=>'text-transform:uppercase'),
                                ));
                            echo $form->error($model,'cpf');
                    ?>
                    </td>
                    <td>
                       <?php echo $form->labelEx($model,'estado_civil'); ?>
                       <?php echo Chtml::activeDropDownList($model, 'estado_civil', 
                                                    Servidor::$ESTADOS_CIVIS,array('size'=>1,'maxlength'=>1)) ?>
                       <?php echo $form->error($model,'estado_civil'); ?> 
                    </td>
                 </tr>
                 
                 <tr>
                    
                    <td >
                        <?php echo $form->labelEx($model,'cns'); ?>
                        <?php echo $form->textField($model,'cns',array('size'=>15,'maxlength'=>15,'style'=>'text-transform:uppercase')); ?>
                        <?php echo $form->error($model,'cns'); ?>
                    </td>
                    
                </tr>
            </tbody>
        </table>
       
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->