<?php

class TituloEleitorController extends Controller
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
        private $_servidor;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array();
	}

	/**
	 * Displays a particular model.
	 */
	public function actionIndex()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),'servidor'=>$this->loadModelServidor(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TituloEleitor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if((isset($_POST['TituloEleitor'])) && ($_GET['id']))
		{
			$model->attributes=$_POST['TituloEleitor'];
                        $model->servidor_cpf = $_GET['id'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->servidor_cpf));
		}

		$this->render('create',array('model'=>$model,'servidor'=>$this->loadModelServidor()));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TituloEleitor']))
		{
			$model->attributes=$_POST['TituloEleitor'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->servidor_cpf));
		}

		$this->render('update',array(
			'model'=>$model,'servidor'=>$this->loadModelServidor(),
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
				$this->_model=TituloEleitor::model()->findbyPk($_GET['id']);
                                if($this->_model===null){
                                    $this->redirect(array('create','id'=>$_GET['id'],'serv'=>$_GET['serv']));
                                }
			if($this->_model===null)
				throw new CHttpException(404,'Servidor não existente no sistema.');
		}
		return $this->_model;
	}

        public function loadModelServidor()
	{
                //pega o servidor pelo parâmetro
            if($this->_servidor===null){
		if(isset($_GET['id']))
                    $this->_servidor=Servidor::model()->findbyPk($_GET['id']);
                
            }
		return $this->_servidor;
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='titulo-eleitor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionView()
	{
                //recupera o o endereçoe o servidor
		$this->render('view',array(
			'model'=>$this->loadModel(),'servidor'=>$this->loadModelServidor(),
		));
	}
}
