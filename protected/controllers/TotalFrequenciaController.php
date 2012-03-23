<?php

Yii::import('application.modules.rbac.components.*');
class TotalFrequenciaController extends Controller
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
        
        private $_RBAC;

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
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),*/
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
                $this->_RBAC->checkAccess(array('viewTotalFrequencia','registered'),true);
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                $this->_RBAC->checkAccess('manageTotalFrequencia',true);
		$model=new TotalFrequencia;
                //inicia os campos com valores
                $model->ano=date('Y');
                $model->mes=date('m');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TotalFrequencia']))
		{
			$model->attributes=$_POST['TotalFrequencia'];
			if($model->save())
				$this->redirect(array('view','ano'=>$model->ano,'mes'=>$model->mes,'serv'=>$model->servidor_cpf));
		}

		$this->render('create',array(
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

		if(isset($_POST['TotalFrequencia']))
		{
			$model->attributes=$_POST['TotalFrequencia'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ano));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	/*public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}*/

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $this->_RBAC->checkAccess('manageTotalFrequencia',true);
		/*$dataProvider=new CActiveDataProvider('TotalFrequencia');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
                $this->redirect(array('admin'));
	}
        
        public function actionList()
	{
                $this->_RBAC->checkAccess(array('manageTotalFrequencia','registered'),true);
		$dataProvider=new CActiveDataProvider('TotalFrequencia');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TotalFrequencia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TotalFrequencia']))
			$model->attributes=$_GET['TotalFrequencia'];

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
			if(isset($_GET['ano'])  && isset($_GET['mes'])  && isset($_GET['serv']))
				$this->_model=TotalFrequencia::model()->with('servidor')->findbyPk(array('ano'=>$_GET['ano'],'mes'=>$_GET['mes'],'servidor_cpf'=>$_GET['serv']));
			if($this->_model===null)
				throw new CHttpException(404,'Ops! A página requerida não existe.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='total-frequencia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
