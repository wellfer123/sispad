<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'medico-executa-item-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> tem preenchimento obrigatório.</p>

        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>
        
        <table>
            <tbody>
                <?php foreach($modelos as $i=>$m): ?>
                
                <tr>
                    <td colspan="4" style="background-color: #63812a; height: 14px; color: white;">
                       <?php echo $itens[$i]->nome ?>
                       <?php echo CHtml::activeHiddenField($m, "[$i]item_id",array('value'=> $itens[$i]->id)); ?>
                    </td>
                </tr>
                <tr >
                    <td>
                        <?php echo $form->labelEx($m,"[$i]quantidade"); ?>
                        <?php echo $form->textField($m,"[$i]quantidade",array('size'=>10)); ?>
                        <?php echo $form->error($m,"[$i]quantidade"); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($m,"[$i]competencia"); ?>
                        <?php echo CHtml::textField("[$i]competencia", $competencia, array('disabled'=>true,'size'=>10)); ?>
                        <?php echo $form->error($m,"[$i]competencia"); ?>
                    </td>
                </tr>
                <tr >
                    <td colspan="2">
                        <?php echo $form->labelEx($m,"[$i]medico_cpf"); ?>
                        <?php echo CHtml::textField("[$i]medico_cpf", $medico->servidor->nome, array('disabled'=>true,'size'=>60)); ?>
                        <?php echo $form->error($m,"[$i]medico_cpf"); ?>
                    </td>
                    <td colspan="2">
                        <?php echo $form->labelEx($m,"[$i]medico_unidade_cnes"); ?>
                        <?php echo CHtml::textField("[$i]medico_unidade_cnes", $medico->unidade->nome, array('disabled'=>true,'size'=>50)); ?>
                        <?php echo $form->error($m,"[$i]medico_unidade_cnes"); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->