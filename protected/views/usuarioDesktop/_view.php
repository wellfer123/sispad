<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('servidor_cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->servidor_cpf), array('view', 'id'=>$data->servidor_cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token')); ?>:</b>
	<?php echo CHtml::encode($data->token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serial_aplicacao')); ?>:</b>
	<?php echo CHtml::encode($data->serial_aplicacao); ?>
	<br />


</div>