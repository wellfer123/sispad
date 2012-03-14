<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CidadeController
 *
 * @author Albuquerque
 */
class CidadeController extends Controller{
    //put your code here
    
    public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('seachname'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionSeachRegional(){
        //if (isset($_GET['regional_id'])){
            echo Cidades::model()->findAll();
        //}
        yii::app()->end();
    }
    
    
    public function actionSeachName(){
            $arr=array();
            if (isset($_GET['term'])){  
                $cid=Cidades::model()->findAll('cidade_nome like :cidadeNome', 
                                                array(':cidadeNome'=>$_GET['term'].'%'));
                foreach ($cid as $cidade){
                    $arr[] = $cidade['cidade_nome'];
                }
            }
            echo CJSON::encode($arr);
            yii::app()->end();
        }

}

?>
