<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h2><?php echo $msg?></h2>
<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Login',
                        'htmlOptions'=>array('class'=>'portlet_form')
		));?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
        'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Todos os campos com <span class="required">*</span> são de prenchimento obrigatório.</p>
        <?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>70)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>30)); ?>
		<?php echo $form->error($model,'password'); ?>
		
           
            <p style="color: red">Caso não tenha se registrado no sistema <a href=<?php echo Yii::app()->createAbsoluteUrl('user/register') ?>>clique aqui</a></p>
            <h3 style="color: red"> ATENÇÂO: o Sispad está liberado para a digitação da produção de Janeiro, Fevereiro e Março</h3>
            <h3 style="color: red"> Utilize o nevegador (browser) Google Chrome</h3>
            <h3 style="color: red"> Email do suporte: suporte.sispad@gmail.com</h3>
            <h4 style="color: red"> Telefone: (81) 3701-1400 (ramal 227)</h4>
            
	</div>

	<div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton('Entrar'); ?>
	</div>

        
<?php $this->endWidget(); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->



