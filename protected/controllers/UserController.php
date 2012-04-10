<?php

class UserController extends SISPADBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

        public $_bodyEmail="Sua conta foi ativada";
        public $_bodyEmailDes="Sua conta foi desativada";
        
        
        
        public function __construct($id, $module = null) {
            parent::__construct($id, $module);
        }

        	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

        public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
                $this->CheckAcessAction();
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

         private function enviaEmail($to,$nameTo,$from,$subject,$body){
             $message = new YiiMailMessage();

                $message->setTo(
                array($to=>$nameTo));
                $message->setFrom($from);
                $message->setSubject($subject);
                $message->setBody($body);

                $numsent = Yii::app()->mail->send($message);
        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegister()
	{
                
		$model=new User('register');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
                        $model->criptografarPassword();
                        $model->ativo=0;
			if($model->save())
                               $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('register',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	/*public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
        
	public function actionActive()
	{
                $this->CheckAcessAction();
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
                        $mo=$this->loadModel();
                        if($mo!=null){
                            $mo->ativo=User::ATIVO;
                            $mo->save();
                            $this->enviaEmail($mo->email,$mo->username,
                                        "sispadcaruaru@gmail.com","ATIVACAO DE CONTA",$this->_bodyEmail);
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
                $this->CheckAcessAction();
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow  via POST request
			$mo=$this->loadModel($id);
                        if($mo!=null){
                            $mo->ativo=User::DESATIVO;
                            $mo->save();
                            $this->enviaEmail($mo->email,$mo->username,
                                        "sispadcaruaru@gmail.com","DESATIVACAO DE CONTA",$this->_bodyEmailDes);
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        public function actionHome(){
            $this->CheckAcessAction();
            $this->render('home');
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->CheckAcessAction();
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->with('servidor')->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        protected function getModelName() {
            return 'User';
        }

}
