<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dia')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dia), array('view', 'id'=>$data->dia)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mes')); ?>:</b>
	<?php echo CHtml::encode($data->mes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servidor_cpf')); ?>:</b>
	<?php echo CHtml::encode($data->servidor_cpf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_envio')); ?>:</b>
	<?php echo CHtml::encode($data->data_envio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motivo')); ?>:</b>
	<?php echo CHtml::encode($data->motivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motivo_id')); ?>:</b>
	<?php echo CHtml::encode($data->motivo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ano')); ?>:</b>
	<?php echo CHtml::encode($data->ano); ?>
	<br />


</div>