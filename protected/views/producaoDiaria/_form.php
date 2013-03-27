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
        <h2> Após o envio não é permitida a atualização dos dados.</h2>

<table>
    <tbody>
        <tr>
            <td colspan="3">
		<?php echo CHtml::label('Unidade', 'unidade'); ?>
		<?php echo CHtml::textField('unidade_nome', $servidor->unidade->nome,array('size'=>80,'readOnly'=>true)); ?>
                
            </td>
        </tr>
        <tr>
            <td colspan="2">
		<?php echo CHtml::label('Gestor', 'gestor'); ?>
		<?php echo CHtml::textField('gestor_nome', $servidor->nome,array('size'=>80,'readOnly'=>true)) ?>

            </td>
            <td>
		<?php echo CHtml::label('Dia(Hoje)', 'dia'); ?>
		<?php echo CHtml::textField('data',$data,array('readOnly'=>true)); ?>
            </td>
        </tr>
    </tbody>
</table>
        
        
<table>
    <thead>
        <tr>
            <td colspan="2">
                <?php echo CHtml::label("Especialidade", 'especialidade')  ?>
            </td>
            <td>
                <?php echo CHtml::label("Quantidade", 'quantidade')  ?>
            </td>
        </tr>
    </thead>
    <tbody>
        
            <?php  foreach ($itens as $key=>$value): ?>
                <tr>
                    <td colspan="2">
                        <?php //echo CHtml::textField("[$key]profissao_nome",$especialidades[$value->profissao_codigo],array('size'=>80))?>
                        <?php  echo $especialidades[$value->profissao_codigo]; ?>
                        <?php echo CHtml::error($value, "profissao_codigo"); ?>
                    </td>
                    <td>
                        <?php  echo CHtml::activeTextField($value, "[$key]quantidade"); ?>
                        <?php echo CHtml::error($value, "quantidade") ?>
                    </td>
                    
                    <?php echo CHtml::activeHiddenField($value, "[$key]servidor_cpf"); ?>
                    <?php echo CHtml::activeHiddenField($value, "[$key]unidade_cnes"); ?>
                    <?php echo CHtml::activeHiddenField($value, "[$key]data"); ?>
                </tr>
            <?php        endforeach; ?>
    </tbody>
</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->