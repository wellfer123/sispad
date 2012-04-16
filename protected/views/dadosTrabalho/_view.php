<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('servidor_cpf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->servidor_cpf), array('view', 'id'=>$data->servidor_cpf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_admissao')); ?>:</b>
	<?php echo CHtml::encode($data->data_admissao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pis')); ?>:</b>
	<?php echo CHtml::encode($data->pis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_horaria')); ?>:</b>
	<?php echo CHtml::encode($data->carga_horaria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turno')); ?>:</b>
	<?php echo CHtml::encode($data->turno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profissao')); ?>:</b>
	<?php echo CHtml::encode($data->profissao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salario')); ?>:</b>
	<?php echo CHtml::encode($data->salario); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('conselho_classe')); ?>:</b>
	<?php echo CHtml::encode($data->conselho_classe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_afastamento')); ?>:</b>
	<?php echo CHtml::encode($data->data_afastamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_retorno')); ?>:</b>
	<?php echo CHtml::encode($data->data_retorno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('situacao_funcional')); ?>:</b>
	<?php echo CHtml::encode($data->situacao_funcional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vinculo')); ?>:</b>
	<?php echo CHtml::encode($data->vinculo); ?>
	<br />

	*/ ?>

</div>