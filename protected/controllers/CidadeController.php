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
class CidadeController extends SISPADBaseController{
    //put your code here
    
    public function accessRules()
	{
		return array();
	}
    public function actionSeachRegional(){
        //if (isset($_GET['regional_id'])){
            echo Cidades::model()->findAll();
        //}
        yii::app()->end();
    }
    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    
    
    public function actionSeachName(){
            $arr=array();
            if (isset($_GET['term'])){  
                $cid=Cidades::model()->findb(35);
                foreach ($cid as $cidade){
                    $arr[] = $cidade['cidade_nome'];
                }
            }
            echo CJSON::encode($arr);
            yii::app()->end();
        }
        
    
        
   public function actionFindCidades() {
            
            //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $cidades = Cidades::model()->with('estado')->findAll('cidade_nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
 
                if (!empty($cidades)) {
                    $out = array();
                    foreach ($cidades as $s) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $s->NomeEstado,  
                            'value' => $s->NomeEstado,
                            'id' => $s->id, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }

    protected function getModelName() {
        return 'Cidade';
    }

}

?>
