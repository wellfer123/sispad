<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'dados-trabalho-form',
        'uniform'=>array('theme'=>'default'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <table>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'profissao'); ?>
                        <?php echo $form->textField($model,'profissao',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'profissao'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'conselho_classe'); ?>
                        <?php echo $form->textField($model,'conselho_classe',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'conselho_classe'); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'salario'); ?>
                        <?php echo $form->textField($model,'salario',array('size'=>7,'maxlength'=>7)); ?>
                        <?php echo $form->error($model,'salario'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'carga_horaria'); ?>
                        <?php echo $form->textField($model,'carga_horaria'); ?>
                        <?php echo $form->error($model,'carga_horaria'); ?>
                    </td>
                    
                    <td>
                        <?php echo $form->labelEx($model,'pis'); ?>
                        <?php echo $form->textField($model,'pis',array('size'=>11,'maxlength'=>11)); ?>
                        <?php echo $form->error($model,'pis'); ?>
                    </td>
                </tr>
                
                
                <tr>
                    
                    <td>
                        <?php echo $form->labelEx($model,'turno'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'turno', DadosTrabalho::$TIPOS_TURNOS, array('maxlength'=>1)) ?>
                        <?php echo $form->error($model,'turno'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'situacao_funcional'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'situacao_funcional', DadosTrabalho::$SITUACOES_FUNCIONAIS, array('maxlength'=>2)) ?>
                        <?php echo $form->error($model,'situacao_funcional'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'vinculo'); ?>
                        <?php echo CHtml::activeDropDownList($model, 'vinculo', DadosTrabalho::$TIPOS_VINCULOS, array('maxlength'=>1)) ?>
                        <?php echo $form->error($model,'vinculo'); ?>
                    </td>
                </tr>
                
                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'data_admissao'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'name'=>'Data',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_admissao',
                                                'htmlOptions'=>array('disabled'=>!$model->isNewRecord)))?>
                        <?php echo $form->error($model,'data_admissao'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'data_afastamento'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'name'=>'Data',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_afastamento',
                                                'htmlOptions'=>array()))?>
                        <?php echo $form->error($model,'data_afastamento'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'data_retorno'); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                                'name'=>'Data',
                                                'language'=>'pt',
                                                'model'=>$model,
                                                'attribute'=>'data_retorno',
                                                'htmlOptions'=>array()))?>
                        <?php echo $form->error($model,'data_retorno'); ?>
                    </td>
                </tr>
                
            </tbody>
        </table>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar'); ?>
	</div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->