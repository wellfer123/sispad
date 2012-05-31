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
            $this->model=$this->loadModel("Servidor","user",Yii::app()->user->cpfservidor);

            $this->render('home');
        }
        
        
        protected function getModelName() {
            
            return 'Perfil';
        }


        public function loadModel($model,$relation=null,$id)
	{
            if($relation!=null){
           
            $_model=$model::model()->with($relation)->findbyPk($id);
            }else{
                 $_model=$model::model()->findbyPk($id);
            }
			if($_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		
		return $_model;
	}


}

?>
