<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('agente_saude_cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->agente_saude_cpf), array('view', 'id'=>$data->agente_saude_cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agente_saude_unidade_cnes')); ?>:</b>
	<?php echo CHtml::encode($data->agente_saude_unidade_cnes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantidade')); ?>:</b>
	<?php echo CHtml::encode($data->quantidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('competencia')); ?>:</b>
	<?php echo CHtml::encode($data->competencia); ?>
	<br />


</div>