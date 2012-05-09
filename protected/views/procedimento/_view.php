<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->codigo), array('view', 'id'=>$data->codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_complexidade')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_complexidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_sexo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_sexo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantidade_maxima_execucao')); ?>:</b>
	<?php echo CHtml::encode($data->quantidade_maxima_execucao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantidade_dias_permanencia')); ?>:</b>
	<?php echo CHtml::encode($data->quantidade_dias_permanencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantidade_pontos')); ?>:</b>
	<?php echo CHtml::encode($data->quantidade_pontos); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('validade_idade_minima')); ?>:</b>
	<?php echo CHtml::encode($data->validade_idade_minima); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validade_idade_maxima')); ?>:</b>
	<?php echo CHtml::encode($data->validade_idade_maxima); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validade_sh')); ?>:</b>
	<?php echo CHtml::encode($data->validade_sh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validade_sa')); ?>:</b>
	<?php echo CHtml::encode($data->validade_sa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validade_sp')); ?>:</b>
	<?php echo CHtml::encode($data->validade_sp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_financiamento')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_financiamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_rubrica')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_rubrica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_competencia')); ?>:</b>
	<?php echo CHtml::encode($data->data_competencia); ?>
	<br />

	*/ ?>

</div>