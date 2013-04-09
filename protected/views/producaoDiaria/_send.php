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
                                                                     ),
                                                                    )); ?>
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
                                                           array("style"=>"width:280px" ,
                                                                'ajax'=>array(
                                                                      'type'=>'POST',
                                                                      'url'=>  Yii::app()->createAbsoluteUrl('producaoDiaria/findProfissionais'),
                                                                      //pega o cnes da unidade e o codigo da especialidade  
                                                                      'data' => 'js:{cbo: $(this).val(), cnes: $('.CHtml::activeId($model, "unidade_cnes").').val()}',
                                                                      'update' => '#'.CHtml::activeId($model, 'profissional_cpf'),
                                                                    ),
                                                                   'empty'=>'Selecione uma especialidade')) ; ?>
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

<?php

//confirma se o usuário que enviar mesmo
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Dialog box 1',
        'autoOpen'=>false,
        'modal'=> true,
        'width' => '500px',
        'buttons' => array(
                            array('text'=>'Enviar','click'=> 'js:function(){ document.getElementById("producao-diaria-form").submit(); $(this).dialog("close"); }'),
                            array('text'=>'Cancelar','click'=> 'js:function(){$(this).dialog("close");}'),
                        ),
    ),
));
    //cada elemento representa um campo para confirmação do usuário
    echo '<div style="margin-border: 10px">'.CHtml::label('', 'dial_unidade', array("id"=>"dial_unidade")).'</div>';
    echo '<div>'.CHtml::label('', 'dial_gestor', array("id"=>"dial_gestor")).'</div>';
    echo '<div>'.CHtml::label('', 'dial_especialidade', array("id"=>"dial_especialidade")).'</div>';
    echo '<div>'.CHtml::label('', 'dial_profissional', array("id"=>"dial_profissional")).'</div>';
    echo '<div>'.CHtml::label('', 'dial_grupo', array("id"=>"dial_grupo")).'</div>';
    echo '<div>'.CHtml::label('', 'dial_observacao', array("id"=>"dial_observacao")).'</div>';
    echo '<div>'.CHtml::label('', 'dial_data', array("id"=>"dial_data")).'</div>';
    echo '<div>'.CHtml::label('', 'dial_quantidade', array("id"=>"dial_quantidade")).'</div>';
    echo '<div>'.CHtml::label('', 'dial_detalhe', array("id"=>"dial_detalhe")).'</div>';
    
    //script que atualiza os valores dos labels anteriores
    $scriptUpdate=' $("#dial_unidade").html("Unidade: " +  $("#'. CHtml::activeId($model, 'unidade_cnes') .'").find("option").filter(":selected").text() );';
    $scriptUpdate=$scriptUpdate.' $("#dial_gestor").html("Gestor: "+ $("#gestor_nome").val() );';
    $scriptUpdate=$scriptUpdate.' $("#dial_especialidade").html("Especialidade: " +  $("#'. CHtml::activeId($model, 'profissao_codigo') .'").find("option").filter(":selected").text() );';
    $scriptUpdate=$scriptUpdate.' $("#dial_profissional").html("Profissional: " +  $("#'. CHtml::activeId($model, 'profissional_cpf') .'").find("option").filter(":selected").text() );';
    $scriptUpdate=$scriptUpdate.' $("#dial_grupo").html("Grupo: " +  $("#'. CHtml::activeId($model, 'grupo_codigo') .'").find("option").filter(":selected").text() );';
    $scriptUpdate=$scriptUpdate.' $("#dial_observacao").html("Observação: " +  $("#'. CHtml::activeId($model, 'observacao_codigo') .'").find("option").filter(":selected").text() );';
    $scriptUpdate=$scriptUpdate.' $("#dial_data").html("Data: " +  $("#'. CHtml::activeId($model, 'data') .'").val() );';
    $scriptUpdate=$scriptUpdate.' $("#dial_quantidade").html("Quantidade: " +  $("#'. CHtml::activeId($model, 'quantidade') .'").val() );';
    $scriptUpdate=$scriptUpdate.' $("#dial_detalhe").html("Detalhe: " +  $("#'. CHtml::activeId($model, 'detalhe') .'").val() );';
    $scriptUpdate=$scriptUpdate.' $("#dialog").dialog("open"); return false;';
    
$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

<div class="row buttons">
	<?php echo CHtml::button('Enviar',array('onclick'=>$scriptUpdate)); ?>
</div>

<?php $this->endWidget(); ?>

        
</div><!-- form -->