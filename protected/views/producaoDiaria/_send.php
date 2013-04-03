<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'producao-diaria-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> são obrigatórios.</p>
        <h1> Após o envio não é permitida a atualização dos dados.</h1>
        
        <?php echo $this->renderMessages(); ?>
	<?php echo $form->errorSummary($model); ?>

<table>
    <tbody>
        <tr>
            <td colspan="3">
		<?php echo CHtml::activeLabel($model, 'unidade_cnes'); ?>
		<?php echo CHtml::textField('unidade_nome', $servidor->unidade->nome,array('size'=>80,'readOnly'=>true)); ?>
                <?php echo CHtml::error($model, 'unidade_cnes') ; ?>
                <?php echo CHtml::activeHiddenField($model, 'unidade_cnes'); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
		<?php echo CHtml::activeLabel($model, 'servidor_cpf'); ?>
		<?php echo CHtml::textField('gestor_nome', $servidor->nome,array('size'=>80,'readOnly'=>true)) ?>
                <?php echo CHtml::error($model, 'servidor_cpf') ; ?>
                <?php echo CHtml::activeHiddenField($model, 'servidor_cpf'); ?>
            </td>
            <td>
		<?php echo CHtml::activeLabel($model, 'data'); ?>
		<?php $this->widget("zii.widgets.jui.CJuiDatePicker",array(
                                                'model'=>$model,
                                                 'attribute'=>'data',
                                                "name"=>"data",
                                                "options"=>array(
                                                    "changeMonth"=>"true", 
                                                    "changeYear"=>"true",  
                                                    'minDate'=>'-1d', //ontem
                                                    'maxDate'=>'0d', //hoje
                                                    "yearRange" => "-99:+0", 
                                                    "showAnim"=>"fadeIn",
                                                ),
                                                "language"=>"pt",)); ?>
                <?php echo CHtml::error($model, 'data') ; ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::label('Especialidade', 'especialidade'); ?>
		<?php echo CHtml::activeDropDownList($model, 'profissao_codigo', $especialidades,array('empty'=>'Selecione uma especialidade')) ; ?>
                <?php echo CHtml::error($model, 'profissao_codigo') ; ?>
            </td>
            <td>
                <?php echo CHtml::activeLabel($model, 'profissional_cpf'); ?>
		<?php echo CHtml::activeDropDownList($model, 'profissional_cpf', $profissionais,array('empty'=>'Selecione um profissional')); ?>
                <?php echo CHtml::error($model, 'profissional_cpf') ; ?>
            </td>
            <td>
                <?php echo CHtml::activeLabel($model, 'quantidade'); ?>
		<?php echo CHtml::activeTextField($model, 'quantidade') ; ?>
                <?php echo CHtml::error($model, 'quantidade') ; ?>
            </td>
        </tr>
    </tbody>
</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->