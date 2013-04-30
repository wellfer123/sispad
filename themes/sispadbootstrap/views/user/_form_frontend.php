<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ));
    ?>
    <p class="note">Campos com <span class="required">*</span> sao obrigatórios</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="control-group">
            <?php
            echo $form->labelEx($model, 'servidor_cpf', array(
                'class' => 'control-label',
            ))
            ?>
            <div class="controls">
                <?php
                echo $form->textField($model, 'servidor_cpf', array(
                    'maxLength' => 11,
                    'class' => 'input-large',
                ));
                ?>
            </div>
            <div class="errorMessage">
                <?php echo $form->error($model, 'servidor_cpf'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php
            echo $form->labelEx($model, 'username', array(
                'class' => 'control-label',
            ))
            ?>
            <div class="controls">
                <?php
                echo $form->textField($model, 'username', array(
                    'maxLength' => 30,
                    'class' => 'input-large',
                ));
                ?>
            </div>
            <div class="errorMessage">
                <?php echo $form->error($model, 'username'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php
            echo $form->labelEx($model, 'password', array(
                'class' => 'control-label',
            ))
            ?>
            <div class="controls">
                <?php
                echo $form->passwordField($model, 'password', array(
                    'maxLength' => 32,
                    'class' => 'input-large'
                ));
                ?>
            </div>
            <div class="errorMessage">
                <?php echo $form->error($model, 'password'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php
            echo $form->labelEx($model, 'email', array(
                'class' => 'control-label',
            ));
            ?>
            <div class="controls">
                <?php
                echo $form->textField($model, 'email', array(
                    'maxLength' => 255,
                    'size' => 70,
                    'class' => 'span4'
                ))
                ?>
            </div>
            <div class="errorMessage">
                <?php echo $form->error($model, 'email'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'verifyCode'); ?>
            <div class="controls">
                <?php $this->widget('CCaptcha'); ?>
                <?php
                echo $form->textField($model, 'verifyCode', array(
                    'class' => 'span4',
                ));
                ?>
            </div>
            <div class="hint">
                Por favor, entre com as letras que são exibidas acima.
                <br/>Não existe diferença entre maiúscula ou minúscula.
            </div>
        </div>
    </div>
    <div class="row buttons">
        <?php
        echo CHtml::submitButton('Registrar-se', array(
            'maxLength' => 255,
            'size' => 70,
            'class' => 'btn btn-success'
        ));
        ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->