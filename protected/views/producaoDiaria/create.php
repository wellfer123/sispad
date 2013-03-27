<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */

$this->breadcrumbs=array(
	'Produção Diária'=>array('adminGestor'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Ver Unidade', 'url'=>array('unidade/view','id'=>$servidor->unidade->cnes)),
        array('label'=>'Histórico Produção Diária', 'url'=>array('producaoDiaria/adminGestor')),
        array('label'=>'Adicionar Especialidades', 'url'=>array('unidadeEspecialidade/add','unidade'=>$servidor->unidade->cnes)),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Envio da Produção Diária/'.$servidor->unidade->nome,
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>

<?php echo $this->renderPartial('_form', 
                                array(
                                    'data'=>$data,
                                    'itens'=>$itens,
                                    'especialidades'=>$especialidades,
                                    'servidor'=>$servidor)); ?>

<?php $this->endWidget(); ?>