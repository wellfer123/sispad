<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'relatorio-procedimento-realizado-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> têm preenchimento garantido.</p>

	<?php echo $form->errorSummary($model); ?>
        <table>
            <tbody>
                
                <tr>
                    <td >
                        
                        <?php echo $form->radioButtonList($model,'relatorio',  
                                                          RelatorioProcedimentoRealizado::$TIPOS_RELATORIOS,array('separator'=>' ')); ?>
                        <?php echo $form->error($model,'relatorio'); ?>
                    </td>
               </tr>
               
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'unidade_cnes'); ?>
                        <?php echo $form->textField($model,'unidade_cnes',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'unidade_cnes'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'profissional_cns'); ?>
                        <?php echo $form->textField($model,'profissional_cns',array('size'=>15,'maxlength'=>15)); ?>
                        <?php echo $form->error($model,'profissional_cns'); ?>
                    </td>

                    <td>
                        <?php echo $form->labelEx($model,'profissional_cbo'); ?>
                        <?php echo $form->textField($model,'profissional_cbo',array('size'=>6,'maxlength'=>6)); ?>
                        <?php echo $form->error($model,'profissional_cbo'); ?>
                    </td>
               </tr>
               
               <tr>
               </tr>
           </tbody>
       </table>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Executar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->