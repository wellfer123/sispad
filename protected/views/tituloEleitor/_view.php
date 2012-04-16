<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('servidor_cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->servidor_cpf), array('view', 'id'=>$data->servidor_cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zona')); ?>:</b>
	<?php echo CHtml::encode($data->zona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('secao')); ?>:</b>
	<?php echo CHtml::encode($data->secao); ?>
	<br />


</div>