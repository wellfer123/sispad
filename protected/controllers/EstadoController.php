<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadoController
 *
 * @author Albuquerque
 */
class EstadoController extends SISPADBaseController{
    //put your code here
    
    public function accessRules()
	{
		return array();
	}
 
        
   public function actionFindEstados() {
            
            //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $estados = Estados::model()->findAll('estado_nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
 
                if (!empty($estados)) {
                    $out = array();
                    foreach ($estados as $s) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $s->estado_nome,  
                            'value' => $s->estado_nome,
                            'id' => $s->id, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }

    protected function getModelName() {
        return 'Estado';
    }

}
?>
