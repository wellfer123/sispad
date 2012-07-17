<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
                
		<?php echo $form->label($model,'odontologo_cpf'); ?>
		<?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model,
                                    'attributes'=>array('unidade_cnes'),
                                    'attribute'=>'odontologo_cpf', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Servidor/findOdontologos'),
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>11,
                                    'relName'=>'odontologo', // the relation name defined above
                                    'displayAttr'=>'ServidorUnidade',  // attribute or pseudo-attribute to display
                                    // length of the AutoComplete/display field, defaults to 50
                                    'autoCompleteLength'=>60,
                                     // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may
                                     // also be defined.  read the code and docs for all options
                                    'options'=>array(
                                        // number of characters that must be typed before
                                            // autoCompleter returns a value, defaults to 2
                                        'minLength'=>4,
                                        ),
                                ));?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meta_id'); ?>
		<?php $this->widget('EJuiAutoCompleteFkField', array(
                                    'model'=>$model, 
                                    'attribute'=>'meta_id', //the FK field (from CJuiInputWidget)
                                     // controller method to return the autoComplete data (from CJuiAutoComplete)
                                    'sourceUrl'=>Yii::app()->createUrl('Meta/findMetas',array('profissao'=>'Odontologo')), 
                                    // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
                                    'showFKField'=>false,
                                    // display size of the FK field.  only matters if not hidden.  defaults to 10
                                    'FKFieldSize'=>10,
                                    'htmlOptions'=>array('style'=>'text-transform:uppercase'),
                                    'relName'=>'meta', // the relation name defined above
                                    'displayAttr'=>'NomeDescricao',  // attribute or pseudo-attribute to display
                                    // length of the AutoComplete/display field, defaults to 50
                                    'autoCompleteLength'=>60,
                                     // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may 
                                     // also be defined.  read the code and docs for all options
                                    'options'=>array(
                                        // number of characters that must be typed before 
                                            // autoCompleter returns a value, defaults to 2
                                        'minLength'=>4, 
                                        ),
                                ));?>
	</div>

        <div class="row">
                            <?php echo $form->labelEx($model,'competencia'); ?>
                            <?php echo Chtml::activeDropDownList($model, 'competencia', 
                                                    CHtml::listData(Competencia::model()->findAll(), 'mes_ano', 'mes_ano'),array('size'=>1,'maxlength'=>6)) ?>
        </div>
	<div class="row buttons">
            
		<?php echo CHtml::submitButton('Pesquisar');?>
            
                <?php /*echo CHtml::ajaxSubmitButton('Pesquisar',Yii::app()->createUrl('odontologoExecutaMeta/admin'),
                                                        
                                                        array(
                                                            //'data'=>array('competencia'=>'22012'),
                                                            'success' => 'function( data ){
                                                                            // handle return data
                                                                                //alert();
                                                                           
                                                                            }',
                                                             'beforeSend' => 'function(){
                                                                               $("#sub").addClass("search-form");
                                                                               $("form").attr("action","http://localhost/sispad/index.php?r=odontologoExecutaMeta/admin");
                                                                               $("form").attr("method","post");
                                                                               console.log("FOI");
                                                                               }',
                                                              'complete' => 'function(){
                                                                   $("#sub").removeClass("search-form");
                                                                    $("form").attr("action","http://localhost/sispad/index.php?r=odontologoExecutaMeta/relatorioMetas");
                                                                               }',
                                                              
                                                            )
                                                         
                                    )*/ ?>
              
            <span class="generate">
                <?php //    echo CHtml::submitButton("Gerar Relatório",array('name'=>'gerar-relatorio')); ?>
            </span>    
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->