<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndicadorController
 *
 * @author Junior Pires
 */
class IndicadorController extends SISPADBaseController{
        public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;



        public function __construct($id, $module = null) {
            parent::__construct($id, $module);
        }

        public function filters()
	{
		return array(
			'accessControl',
		);
	}

        public function actionCreate() {
             $model=new Indicador();



		//Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Indicador']))
		{

                        $model->attributes=$_POST['Indicador'];

			if($model->save()){
                            $this->addMessageSuccess("Indicador criado!");
                                  $model=new Indicador();
                        }

                }

               



		$this->render('create',array(
			'model'=>$model
		));

        }

        public function actionAdmin()
	{
                //$this->CheckAcessAction();
		$model=new Indicador('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Indicador']))
			$model->attributes=$_GET['Indicador'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        

        public function actionIndex() {
            $model = new Indicador();
//            $dadosTrabalho = DadosTrabalho::model()->findByPk(Yii::app()->user->cpfservidor);
//            $profissaoCodigo = $dadosTrabalho->profissao_codigo;
            $this->render('view',array(
			'model'=>$model,
                       // 'profissaoCodigo'=>$profissaoCodigo,
		));
        }

    public function actionActive()
	{
               // $this->CheckAcessAction();
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
                        $mo=$this->loadModel();
                        if($mo!=null){
                            $mo->status=Indicador::ATIVO;
                            $mo->save();
                            //$this->enviaEmail($mo->email,$mo->username,
                                       // "sispadcaruaru@gmail.com","ATIVACAO DE CONTA",$this->_bodyEmail);
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


        public function actionInactive($id)
	{
                //$this->CheckAcessAction();
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow  via POST request
			$mo=$this->loadModel($id);
                        if($mo!=null){
                            $mo->status=Indicador::DESATIVO;
                            $mo->save();
                            //$this->enviaEmail($mo->email,$mo->username,
                                       // "sispadcaruaru@gmail.com","DESATIVACAO DE CONTA",$this->_bodyEmailDes);
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

        public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Indicador::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}



        protected function getModelName() {
            return 'Indicador';
    }

     protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='indicador-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
?>
