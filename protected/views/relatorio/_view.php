<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('conteudo')); ?>:</b>
	<?php //echo CHtml::encode($data->conteudo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_envio')); ?>:</b>
	<?php echo CHtml::encode($data->data_envio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_trabalho')); ?>:</b>
	<?php echo CHtml::encode($data->data_trabalho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servidor_cpf')); ?>:</b>
	<?php echo CHtml::encode($data->servidor_cpf); ?>
	<br />


</div>