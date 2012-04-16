<?php
Yii::import('application.services.GridMenu');

$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Administracao',
                        'htmlOptions'=>array('class'=>'portlet_administracao')
		));
                GridMenu::menu(array(
                        array('icon'=>Yii::app()->request->baseUrl.'/css/group.png',
                              'title'=>'exemploHoje',
                              'link'=>'http://localhost/sispad'),
                        array('icon'=>Yii::app()->request->baseUrl.'/css/group.png',
                              'title'=>'exemploAgora',
                              'link'=>'sispad'),
                        array('icon'=>Yii::app()->request->baseUrl.'/css/group.png',
                              'title'=>'exemploHoje',
                              'link'=>'sispad'),
                        array('icon'=>Yii::app()->request->baseUrl.'/css/group.png',
                              'title'=>'exemploAgora',
                              'link'=>'sispad'),
                        array('icon'=>Yii::app()->request->baseUrl.'/css/group.png',
                              'title'=>'exemploHoje',
                              'link'=>'sispad'),
                        array('icon'=>Yii::app()->request->baseUrl.'/css/group.png',
                              'title'=>'exemploAgora',
                              'link'=>'sispad')
                        
          
                    
                    
                ),array('columns'=>4));

                //echo"<table><tr><td>um</td/></tr></table>";
$this->endWidget();

?>
