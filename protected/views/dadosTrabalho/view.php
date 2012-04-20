<?php
$this->breadcrumbs=array(
	'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
	$model->servidor->nome,
);

$this->menu=array(
	array('label'=>'Atualizar Dados de Trabalho', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
);
?>
<div class="update">
<h1>Dados de Trabalho do Servidor <?php echo $model->servidor->nome; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'pis',
		'carga_horaria',
		'turno',
                array(
                    'label'=>'Turno',
                    'value'=>$model->getLabelTurno(),
                ),
		'salario',
                array(
                    'label'=>'Profissão',
                    'value'=>$model->profissao->nome,
                ),
                array(
                    'label'=>'Vínculo',
                    'value'=>$model->getLabelVinculo(),
                ),
                array(
                    'label'=>'Situação Funcional',
                    'value'=>$model->getLabelSituacaoFuncional(),
                ),
		'conselho_classe',
		'data_afastamento',
		'data_admissao',
		'data_retorno',
	),
)); ?>

</div>