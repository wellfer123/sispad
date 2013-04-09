<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
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
            <td colspan="1">
		<?php echo CHtml::activeLabel($model, 'unidade_cnes'); ?>
                <?php echo CHtml::activeDropDownList($model, 'unidade_cnes', CHtml::listData( $unidades,'cnes','nome'),
                                                            array('ajax'=>array(
                                                                      'type'=>'POST',
                                                                      'url'=>  Yii::app()->createAbsoluteUrl('producaoDiaria/findEspecialidades'),
                                                                      'data' => 'js:{unidade: $(this).val()}',
                                                                      'update' => '#'.CHtml::activeId($model, 'profissao_codigo'),
                                                            ))); ?>
                <?php echo CHtml::error($model, 'unidade_cnes') ; ?>
            </td>
            <td colspan="2">
		<?php echo CHtml::activeLabel($model, 'servidor_cpf'); ?>
		<?php echo CHtml::textField('gestor_nome', $servidor->nome,array('size'=>60,'readOnly'=>true)) ?>
                <?php echo CHtml::error($model, 'servidor_cpf') ; ?>
                <?php echo CHtml::activeHiddenField($model, 'servidor_cpf'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::label('Especialidade', 'especialidade'); ?>
		<?php echo CHtml::activeDropDownList($model, 'profissao_codigo', CHtml::listData($especialidades, 'codigo', 'nome'),
                                                           array('ajax'=>array(
                                                                      'type'=>'POST',
                                                                      'url'=>  Yii::app()->createAbsoluteUrl('producaoDiaria/findProfissionais'),
                                                                      //pega o cnes da unidade e o codigo da especialidade  
                                                                      'data' => 'js:{cbo: $(this).val(), cnes: $('.CHtml::activeId($model, "unidade_cnes").').val()}',
                                                                      'update' => '#'.CHtml::activeId($model, 'profissional_cpf'),
                                                            ))) ; ?>
                <?php echo CHtml::error($model, 'profissao_codigo') ; ?>
            </td>
            <td colspan="2">
                <?php echo CHtml::activeLabel($model, 'profissional_cpf'); ?>
		<?php echo CHtml::activeDropDownList($model, 'profissional_cpf',  CHtml::listData($profissionais, 'cpf', 'servidor.nome')); ?>
                <?php echo CHtml::error($model, 'profissional_cpf') ; ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?php echo CHtml::activeLabel($model, 'grupo_codigo'); ?>
		<?php echo CHtml::activeDropDownList($model, 'grupo_codigo',  CHtml::listData($grupos,'codigo','nome'),array('empty'=>'Selecione um grupo')); ?>
                <?php echo CHtml::error($model, 'grupo_codigo') ; ?>
            </td>
        </tr>
        <tr>
            <td>
		<?php echo CHtml::activeLabel($model, 'data'); ?>
		<?php $this->widget("zii.widgets.jui.CJuiDatePicker",array(
                                                'model'=>$model,
                                                 'attribute'=>'data',
                                                "name"=>"data",
                                                "options"=>array(
                                                    "changeMonth"=>"true", 
                                                    "changeYear"=>"true",  
                                                    'minDate'=>'-20d', //ontem
                                                    'maxDate'=>'0d', //hoje
                                                    "yearRange" => "-99:+0", 
                                                    "showAnim"=>"fadeIn",
                                                ),
                                                "language"=>"pt",)); ?>
                <?php echo CHtml::error($model, 'data') ; ?>
            </td>
            
            <td>
                <?php echo CHtml::activeLabel($model, 'quantidade'); ?>
		<?php echo CHtml::activeTextField($model, 'quantidade') ; ?>
                <?php echo CHtml::error($model, 'quantidade') ; ?>
            </td>
            <td >
                <?php echo CHtml::activeLabel($model, 'observacao_codigo'); ?>
		<?php echo CHtml::activeDropDownList($model, 'observacao_codigo',  CHtml::listData($observacoes, 'codigo', 'nome'),array('empty'=>'Opcional')); ?>
                <?php echo CHtml::error($model, 'observacao_codigo') ; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo CHtml::label('Detalhe (Opcional)', 'detalhe'); ?>
		<?php echo CHtml::activeTextArea($model, 'detalhe',array('rows'=>'5')); ?>
                <?php echo CHtml::error($model, 'detalhe') ; ?>
            </td>
        </tr>
    </tbody>
</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->