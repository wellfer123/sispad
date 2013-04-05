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
    public $layout="//layouts/perfil2";
    public $model;
    
    public function actionIndex(){
            
            
            $this->redirect(array('home'));
        }
        
        
    public function actionHome(){
            $this->CheckAcessAction();
            $this->model=$this->loadModel(array('unidade'),Yii::app()->user->cpfservidor);

            $this->render('home');
        }
        
        
        protected function getModelName() {
            
            return 'Perfil';
        }


        public function loadModel($relation,$id)
	{
            if($relation!=null){
           
            $_model=Servidor::model()->findbyPk($id);
            }else{
                 $_model=Servidor::model()->findbyPk($id);
            }
			if($_model===null)
				throw new CHttpException(404,'A página requisitada não existe!');
		
		return $_model;
	}


}

?>
