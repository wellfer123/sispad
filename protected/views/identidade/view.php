<?php
Yii::import('application.services.FormataData');
$this->breadcrumbs=array(
	'Servidor'=>array('Servidor/view','id'=>$model->servidor_cpf),
        'Identidade de '.$model->servidor->nome,
);

$this->menu=array(
	array('label'=>'Atualizar identidade', 'url'=>array('update', 'id'=>$model->servidor_cpf)),
);
?>

<div class="update">
<h3>Identidade de <?php echo $model->servidor->nome; ?></h3>


</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'servidor_cpf',
		'nome_pai',
		'nome_mae',
		'data_nascimento',
		'numero',
                array(
                    'label'=>'UF',
                    'value'=>$model->estado->estado_nome.' - '.$model->estado->estado_sigla,
                ),
                array(
                    'label'=>'Orgão Expedidor',
                    'value'=>$model->orgao_expedidor.' - '.$model->getLabelOrgaoExpedidor(),
                ),
                array(
                    'label'=>'Cidade',
                    'value'=>$model->cidadeNaturalidade->cidade_nome,
                ),
		array(
                    'label'=>'Sexo',
                    'value'=>$model->getLabelSexo(),
                ),
	),
)); ?>

