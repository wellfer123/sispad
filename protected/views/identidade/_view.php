<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('servidor_cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->servidor_cpf), array('view', 'id'=>$data->servidor_cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_nascimento')); ?>:</b>
	<?php echo CHtml::encode($data->data_nascimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orgao_expedidor')); ?>:</b>
	<?php echo CHtml::encode($data->orgao_expedidor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uf')); ?>:</b>
	<?php echo CHtml::encode($data->uf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sexo')); ?>:</b>
	<?php echo CHtml::encode($data->sexo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_naturalidade_id')); ?>:</b>
	<?php echo CHtml::encode($data->estado_naturalidade_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cidade_naturalidade_id')); ?>:</b>
	<?php echo CHtml::encode($data->cidade_naturalidade_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_pai')); ?>:</b>
	<?php echo CHtml::encode($data->nome_pai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_mae')); ?>:</b>
	<?php echo CHtml::encode($data->nome_mae); ?>
	<br />

	*/ ?>

</div>