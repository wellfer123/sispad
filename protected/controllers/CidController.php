<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CidController
 *
 * @author JuniorPires
 */
class CidController extends SISPADBaseController{
    //put your code here
    
    public function accessRules()
	{
		return array();
	}
  
    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }


   
   
   public function actionFindCids() {
            
            //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $cidades = Cid::model()->findAll('nome  like :pesquisa or codigo like :pesquisa',array(':pesquisa'=> '%'.strtoupper(trim($q)).'%'));
 
                if (!empty($cidades)) {
                    $out = array();
                    foreach ($cidades as $s) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $s->NomeCodigo,  
                            'value' => $s->NomeCodigo,
                            'id' => $s->codigo, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }

    protected function getModelName() {
        return 'Cid';
    }

}

?>
