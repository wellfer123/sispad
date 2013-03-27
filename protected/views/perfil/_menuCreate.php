<?php
Yii::import('application.services.GridMenu');

$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Cadastro',
                        'htmlOptions'=>array('class'=>'portlet_cadastro')
		));
                GridMenu::menu(array(
                        array('icon'=>Yii::app()->request->baseUrl.'/images/production.png',
                              'title'=>'Enviar produção diária',
                              'link'=>' index.php?r=Relatorio/create'),
                        array('icon'=>Yii::app()->request->baseUrl.'/images/report.png',
                              'title'=>'Consultar Produção diária',
                              'link'=>Yii::app()->createAbsoluteUrl('producaoDiaria/admin')),
                            ),array('columns'=>4));
    


   
    
$this->endWidget();
?>
