<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_area')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->codigo_area), array('view', 'id'=>$data->codigo_area)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_segmento')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_segmento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unidade_cnes')); ?>:</b>
	<?php echo CHtml::encode($data->unidade_cnes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_microarea')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_microarea); ?>
	<br />


</div>