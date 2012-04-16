<?php
Yii::import('application.services.GridMenu');

$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro',
                        'htmlOptions'=>array('class'=>'portlet_cadastro')
		));
                GridMenu::menu(array(
                        array('icon'=>Yii::app()->request->baseUrl.'/css/form.png',
                              'title'=>'Enviar Relatório',
                              'link'=>' index.php?r=Relatorio/create'),
                        array('icon'=>Yii::app()->request->baseUrl.'/css/group.png',
                              'title'=>'Enviar Frequência',
                              'link'=>'index.php?r=TotalFrequencia/create'),
                            ),array('columns'=>4));
    


   
    
$this->endWidget();
?>
