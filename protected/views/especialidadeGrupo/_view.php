<?php
/* @var $this EspecialidadeGrupoController */
/* @var $data EspecialidadeGrupo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('profissao_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->profissao_codigo), array('view', 'profissao_codigo'=>$data->profissao_codigo,'grupo_codigo'=>$data->grupo_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grupo_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->grupo_codigo); ?>
	<br />


</div>