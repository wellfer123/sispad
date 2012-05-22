<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ano')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ano), array('view', 'id'=>$data->ano)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mes')); ?>:</b>
	<?php echo CHtml::encode($data->mes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantidade')); ?>:</b>
	<?php echo CHtml::encode($data->quantidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_envio')); ?>:</b>
	<?php echo CHtml::encode($data->data_envio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servidor_cpf')); ?>:</b>
	<?php echo CHtml::encode($data->servidor_cpf); ?>
	<br />


</div>