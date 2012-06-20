<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('odontologo_cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->odontologo_cpf), array('view', 'id'=>$data->odontologo_cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('odontologo_unidade_cnes')); ?>:</b>
	<?php echo CHtml::encode($data->odontologo_unidade_cnes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantidade')); ?>:</b>
	<?php echo CHtml::encode($data->quantidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('competencia')); ?>:</b>
	<?php echo CHtml::encode($data->competencia); ?>
	<br />


</div>