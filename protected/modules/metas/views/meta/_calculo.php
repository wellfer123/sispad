 
<div class="form" >

<?php $form=$this->beginWidget('SISPADActiveForm', array(
	'id'=>'meta-form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,


)); ?>


        <?php echo $this->renderMessages(); ?>
        <table>
            <tbody>
               <tr>
                   <td>
                       <?php echo CHtml::label('Competência','labelCompetencia' ) ?> 
                   </td>
                   <td colspan="3">
                       <?php echo Chtml::dropDownList('competencia',null,  $competencias,array('size'=>1,'maxlength'=>6)) ?>
                   </td>
               </tr>  
            </tbody>
        </table>
    
 <div id="main" >
        <table>
            <tbody>
            <thead style="background-color: #63812a; height: 14px; color: white;">
                    <td>
                        Profissão
                    </td>
                    <td>
                        Lançar Meta
                    </td>
            </thead>
            
                <?php foreach ($profissoes as $i=>$pro): ?>
                <tr>
                    <td>
                        <?php echo CHtml::label($pro['label'],$i.$pro['label'] ) ?> 
                    </td>
                    <td>
                        <div class="row buttons">
                            <?php echo CHtml::ajaxSubmitButton($pro['button'], Yii::app()->createUrl($pro['action']),
                                                        
                                                        array(
                                                            //'data'=>array('competencia'=>'22012'),
                                                            'success' => 'function( data ){
                                                                            // handle return data
                                                                                //alert();
                                                                            $("#'.$i.'").attr("disabled", true);
                                                                            }',
                                                              'beforeSend' => 'function(){
                                                                               $("#main").addClass("loading");}',
                                                              'complete' => 'function(){
                                                                                $("#main").removeClass("loading");}',
                                                              
                                                            ),
                                                         array('id'=>$i)
                                    ) ?>
                        </div>
                    </td>
                </tr>
              <?php endforeach; ?> 
              
           
            </tbody>
        </table>
     </div>
<?php $this->endWidget(); ?>


</div>