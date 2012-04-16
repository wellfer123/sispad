<<<<<<< HEAD
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
=======
<?php

$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Administracao',
                        'htmlOptions'=>array('class'=>'portlet_administracao')
		));
                    echo "<ul>
                                <li>TESTE</li>
                                <li>TESTE</li>
                                <li>TESTE</li>
                                <li>TESTE</li>
                                <li>TESTE</li>
                                
                          </ul>";
$this->endWidget();

?>
>>>>>>> 8c7a80812f01051c94758f9823dab8b93b074534
