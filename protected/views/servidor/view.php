<?php
$this->breadcrumbs=array(
	'Servidores'=>array('index'),
	$model->nome,
);

$this->menu=array(
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
                                 array('endereco/view','cpf'=>$model->cpf,'id'=>$model->endereco_id,'serv'=>$model->nome)).' / '.
                            CHtml::link('Dados do Trabalho',
                                 array('DadosTrabalho/view','id'=>$model->cpf,'serv'=>$model->nome)).' / '.
                            CHtml::link('Identidade',
                                 array('Identidade/view','id'=>$model->cpf,'serv'=>$model->nome)).' / '.
                            CHtml::link('Título de Eleitor',
                                 array('TituloEleitor/view','id'=>$model->cpf,'serv'=>$model->nome)),
        ),
	),
)); ?>

</div>
