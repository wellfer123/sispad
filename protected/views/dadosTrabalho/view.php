<?php
$this->breadcrumbs=array(
	'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
        'Dados de Trabalho de '.$model->servidor->nome,
);

$this->menu=array(
	array('label'=>'Atualizar Dados de Trabalho', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
);
?>
<div class="update">
<h3>Dados de Trabalho de <?php echo $model->servidor->nome; ?></h3>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'pis',
		'carga_horaria',
            'profissao_codigo',
                array(
                    'label'=>'Turno',
                    'value'=>$model->getLabelTurno(),
                ),
		'salario',
                array(
                    'label'=>'Profissão',
                    'value'=>Profissao::model()->findByPk($model->profissao_codigo)->nome,
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

