<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<div class="well page-content">
    <h2 class="page-title">Login</h2>
    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'block' => true,
            'fade' => true,
            'closeText' => '×',
            'alerts' => array(// configurations per alert type
                'success' => array('block' => true, 'fade' => true, 'closeText' => '×'), // success, info, warning, error or danger
            ),
        ));
        ?>
        <p class="text-info"><?php echo $msg ?></p>
    <?php endif; ?>
    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => true,
        ));
        ?>
        <p class="note">Todos os campos com <span class="required">*</span> são de prenchimento obrigatório.</p>
        <?php echo $form->errorSummary($model); ?>
        <div class="control-group">
            <?php
            echo $form->labelEx($model, 'email', array(
                'class' => 'control-label'
            ));
            ?>
            <div class="controls">
                <?php
                echo $form->textField($model, 'email', array(
                    'class' => 'span4',
                    'size' => 70,
                ));
                ?>
            </div>
            <div class="errorMessage">
                <?php echo $form->error($model, 'email'); ?>
            </div>
        </div>

        <div class="control-group">
            <?php
            echo $form->labelEx($model, 'password', array(
                'class' => 'control-label'
            ));
            ?>
            <div class="control-group">
                <?php
                echo $form->passwordField($model, 'password', array(
                    'class' => 'span3',
                    'size' => 30,
                ));
                ?>
            </div>
            <div class="errorMessage">
                <?php echo $form->error($model, 'password'); ?>
            </div>
        </div>

        <p style="color: red">Caso não tenha se registrado no sistema <a href=<?php echo Yii::app()->createAbsoluteUrl('user/register') ?>>clique aqui</a></p>

        <div class="login-warning-box">
            <p class="login-warning"> Utilize o nevegador (browser) Google Chrome</p>
            <p class="login-warning"> Email do suporte: suporte.sispad@gmail.com</p>
            <p class="login-warning"> Telefone: (81) 3701-1400 (ramal 227)</p>
        </div>
        <?php echo CHtml::submitButton('Entrar'); ?>
        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
