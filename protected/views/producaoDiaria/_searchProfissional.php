<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'unidade'); ?>
                <?php echo Chtml::activeDropDownList($model, 'unidade', $unidades,array('ajax'=>array(
                                                                      'type'=>'POST',
                                                                      'url'=>  Yii::app()->createAbsoluteUrl('producaoDiaria/findProfissionaisPorUnidade'),
                                                                      //pega o cnes da unidade e o codigo da especialidade  
                                                                      'data' => 'js:{cnes: $(this).val()}',
                                                                      'update' => '#'.CHtml::activeId($model, 'profissional'),
                                                                    ),'empty'=>'Todas as unidades')); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'profissional'); ?>
                <?php echo Chtml::activeDropDownList($model, 'profissional',CHtml::listData($profissionais, 'servidor.cpf', 'servidor.nome'),array('empty'=>'Todos os profissionais')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ano'); ?>
                <?php echo Chtml::activeDropDownList($model, 'ano', $anos); ?>
	</div>

	<div class="row buttons">
	    <?php //echo CHtml::submitButton('Pesquisar'); ?>
            <?php echo CHtml::button('Pesquisar', array(
                    'submit' => CController::createUrl($this->route),//, array('unidade'=>$model->unidade,'ano'=>$model->ano)),
                )); ?>
		<?php echo CHtml::button('Relatório Excel', array(
                    'submit' => CController::createUrl("producaoDiaria/".$relatorio),//, array('unidade'=>$model->unidade,'ano'=>$model->ano)),
                )); ?>
                <?php //echo CHtml::link('Relatorio Excel',Yii::app()->createUrl("producaoDiaria/relatorioMonthEspecialidade",array('id'=>1))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->