<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */

$this->breadcrumbs=array(
	'Producao Diária',
	'Visualização',
);


?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Unidade',
                    'value' => $model->unidade->nome,
                ),
                array(
                    'label'=>'Gestor',
                    'value' => $model->gestor->nome,
                ),
                array(
                    'label'=>'Profissional',
                    'value' => $model->profissional->nome,
                ),
                array(
                    'label'=>'Especialidade',
                    'value' => $model->especialidade->nome,
                ),
                array(
                    'label'=>'Grupo',
                    'value' => $model->grupo->nome,
                ),
		'quantidade',
                array(
                    'label'=>'Grupo',
                    'value' => ParserDate::inverteDataEnToPt($model->data),
                )
	),
)); ?>
