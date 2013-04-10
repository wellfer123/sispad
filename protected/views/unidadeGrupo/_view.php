<?php
/* @var $this UnidadeGrupoController */
/* @var $data UnidadeGrupo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('unidade_cnes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->unidade_cnes), array('view', 'id'=>$data->unidade_cnes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grupo_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->grupo_codigo); ?>
	<br />


</div>