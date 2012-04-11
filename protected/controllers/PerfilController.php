<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerfilController
 *
 * @author Albuquerque
 */
class PerfilController extends SISPADBaseController{
    //put your code here
    
    
    
    public function actionIndex(){
            $this->redirect(array('home'));
        }
        
        
    public function actionHome(){
            $this->CheckAcessAction();
            $this->render('home');
        }
        
        
        protected function getModelName() {
            
            return 'Perfil';
        }

}

?>
