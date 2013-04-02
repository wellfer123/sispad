<?php
/* @var $this UnidadeEspecialidadeController */
/* @var $model UnidadeEspecialidade */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('SISPADActiveForm', array(
        'id' => 'unidade-especialidade-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Campso com <span class="required">*</span> são obrigatórios.</p>

                <?php echo $form->errorSummary($model); ?>
    <table>
        <tbody>
            <tr>
                <td>
                        <?php echo $form->labelEx($model, 'grupo_codigo'); ?>
                        <?php echo Chtml::activeDropDownList($model, 'grupo_codigo', $grupos) ?>
                        <?php echo $form->error($model, 'grupo_codigo'); ?>
                        <?php echo CHtml::activeHiddenField($model, 'unidade_cnes'); ?>
                    
                </td>
                <td>
                        <?php echo CHtml::label('Especialidade: CBO/Profissão', 'cbo') ?>
                        <?php
                        $this->widget('EJuiAutoCompleteFkField', array(
                            'model' => $model,
                            'attribute' => 'profissao_codigo', //the FK field (from CJuiInputWidget)
                            // controller method to return the autoComplete data (from CJuiAutoComplete)
                            'sourceUrl' => Yii::app()->createUrl('Profissao/findProfissoesCboSaude'),
                            // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                            'showFKField' => false,
                            // display size of the FK field.  only matters if not hidden.  defaults to 10
                            'FKFieldSize' => 11,
                            'htmlOptions' => array('style' => 'text-transform:uppercase'),
                            'displayAttr' => 'nome', // attribute or pseudo-attribute to display
                            // length of the AutoComplete/display field, defaults to 50
                            'autoCompleteLength' => 60,
                            'options' => array(
                                'minLength' => 4,
                            ),
                        ));
                        ?>
                    <?php echo $form->error($model, 'profissao_codigo'); ?>
                </td>
            </tr>
        </tbody>
    </table>


    <div class="row buttons">
    <?php echo CHtml::submitButton('Adicionar') ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
