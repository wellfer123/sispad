<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('enfermeiro_cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->enfermeiro_cpf), array('view', 'id'=>$data->enfermeiro_cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unidade_cnes')); ?>:</b>
	<?php echo CHtml::encode($data->unidade_cnes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_id')); ?>:</b>
	<?php echo CHtml::encode($data->meta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->data_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_fim')); ?>:</b>
	<?php echo CHtml::encode($data->data_fim); ?>
	<br />


</div>