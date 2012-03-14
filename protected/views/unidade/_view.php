<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cnes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cnes), array('view', 'id'=>$data->cnes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
             
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cidade_id')); ?>:</b>
	<?php echo CHtml::encode($data->cidade); ?>
	<br />


</div>