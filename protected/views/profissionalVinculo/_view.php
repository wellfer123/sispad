<?php
/* @var $this ProfissionalVinculoController */
/* @var $data ProfissionalVinculo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cpf), array('view', 'id'=>$data->cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unidade_cnes')); ?>:</b>
	<?php echo CHtml::encode($data->unidade_cnes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_profissao')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_profissao); ?>
	<br />


</div>