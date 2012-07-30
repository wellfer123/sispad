<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'meta-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,


)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>
        
        <table>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'nome'); ?>
                        <?php echo $form->textField($model,'nome',array('disabled'=>true)); ?>
                        <?php echo $form->error($model,'nome'); ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'periodicidade_id'); ?>
                        <?php echo $form->dropDownList($model,'periodicidade_id',CHtml::listData(Periodicidade::model()->findAll(),'id','nome'
                                                        ),array('disabled'=>true))    ;?>
                        <?php echo $form->error($model,'periodicidade_id'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'valor'); ?>
                        <?php echo $form->textField($model,'valor'); ?>
                        <?php echo $form->error($model,'valor'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'percentagem'); ?>
                        <?php echo $form->textField($model,'percentagem').'%'; ?>
                        <?php echo $form->error($model,'percentagem'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'tipo'); ?>
                        <?php echo $form->dropDownList($model,'tipo',array("IT"=>'Itens',"PR"=>'Procedimento'),array('disabled'=>true));?>
                        <?php echo $form->error($model,'tipo'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        <?php
                                $this->widget('application.extensions.jmultiselect2side.Jmultiselect2side',array(
                                    'model'=>$model,
                                    'attribute'=>'cargos',
                                    'labelsx'=>'Disponíveis',
                                    'labeldx'=>'Selecionados',
                                    'moveOptions'=>false,
                                  'list'=>  CHtml::listData($cargos, 'id', 'nome'),
                             ));
                         ?>
                    </td>
                </tr>
            </tbody>
        </table>
        
      
        <div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar'); ?>
	</div>

<?php $this->endWidget(); ?>


</div>