<?php
/* @var $this UnidadeGestorController */
/* @var $data UnidadeGestor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('unidade_cnes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->unidade_cnes), array('view', 'id'=>$data->unidade_cnes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servidor_cpf')); ?>:</b>
	<?php echo CHtml::encode($data->servidor_cpf); ?>
	<br />


</div>