<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cns')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cns), array('view', 'id'=>$data->cns)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sexo')); ?>:</b>
	<?php echo CHtml::encode($data->sexo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_nascimento')); ?>:</b>
	<?php echo CHtml::encode($data->data_nascimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cidade')); ?>:</b>
	<?php echo CHtml::encode($data->cidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nacionalidade')); ?>:</b>
	<?php echo CHtml::encode($data->nacionalidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idade')); ?>:</b>
	<?php echo CHtml::encode($data->idade); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('raca')); ?>:</b>
	<?php echo CHtml::encode($data->raca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etnia')); ?>:</b>
	<?php echo CHtml::encode($data->etnia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ultima_atualizacao')); ?>:</b>
	<?php echo CHtml::encode($data->ultima_atualizacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_cadastro')); ?>:</b>
	<?php echo CHtml::encode($data->data_cadastro); ?>
	<br />

	*/ ?>

</div>