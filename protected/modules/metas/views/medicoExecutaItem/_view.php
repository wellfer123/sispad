<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('medico_cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->medico_cpf), array('view', 'id'=>$data->medico_cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('medico_unidade_cnes')); ?>:</b>
	<?php echo CHtml::encode($data->medico_unidade_cnes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantidade')); ?>:</b>
	<?php echo CHtml::encode($data->quantidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('competencia')); ?>:</b>
	<?php echo CHtml::encode($data->competencia); ?>
	<br />


</div>