<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mes_ano')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mes_ano), array('view', 'id'=>$data->mes_ano)); ?>
	<br />

	<b><?php echo CHtml::encode("Status"); ?>:</b>
	<?php echo CHtml::encode($data->labelStatus()); ?>
	<br />


</div>