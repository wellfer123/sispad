<?php
$this->breadcrumbs=array(
	'Servidores'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Cadastrar Dados de Trabalho', 'url'=>array('DadosTrabalho/index','id'=>$model->cpf)),
	array('label'=>'Cadastrar Identidade', 'url'=>array('Identidade/index','id'=>$model->cpf)),
	array('label'=>'Cadastrar Título de Eleitor', 'url'=>array('TituloEleitor/index','id'=>$model->cpf)),
	array('label'=>'Cadastrar Endereço', 'url'=>array('Endereco/index','id'=>$model->cpf)),
	array('label'=>'Cadastrar Servidor', 'url'=>array('servidor/create')),
	array('label'=>'Atualizar Servidor', 'url'=>array('update', 'id'=>$model->cpf)),
	array('label'=>'Gerenciamento de Servidores', 'url'=>array('admin')),
);
?>

<div class="update">
<h2>Servidor: <?php echo $model->nome; ?> </h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cpf',
		'matricula',
                array(
                    'label'=>'Estado Civil',
                    'value'=>$model->getLabelEstadoCivil(),
                ),
                array(
                    'label'=>'Unidade',
                    'value'=>$model->unidade->nome,
                ),
                array(               // related city displayed as a link
                    'label'=>'Outros Dados',
                    'type'=>'raw',
                    'value'=>CHtml::link('Endereço',
                                 array('endereco/view','id'=>$model->cpf)).' / '.
                            CHtml::link('Dados do Trabalho',
                                 array('DadosTrabalho/view','id'=>$model->cpf)).' / '.
                            CHtml::link('Identidade',
                                 array('Identidade/view','id'=>$model->cpf)).' / '.
                            CHtml::link('Dados do Trabalho',
                                 array('Título de Eleitor/view','id'=>$model->cpf)),
        ),
	),
)); ?>

</div>
