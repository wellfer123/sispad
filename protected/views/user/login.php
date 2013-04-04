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
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		
            <p>Caso não tenha se registrado no sistema <a href=<?php echo Yii::app()->createAbsoluteUrl('user/register') ?>>clique aqui</a></p>
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



