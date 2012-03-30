<?php


class TotalFrequenciaController extends SISPADBaseController{
	
    
    public $layout='//layouts/column2';
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
        

        	/**
	 * @return array action filters
	 */
        
        public function __construct($id, $module = null) {
            parent::__construct($id, $module);
        }

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
                if(isset($_GET['serv'])){
                    
                    $this->_RBAC->checkAccess('registered',true);
                    //se or o dono das frequencias ou se for o gerenciador
                    if($_GET['serv']==Yii::app()->user->cpfservidor || 
                            $this->_RBAC->checkAccess('manageTotalFrequencia')){
                        
                      $this->render('view',array(
                            'model'=>$this->loadModel(),
                       ));  
                    }
                    else{
                        $this->_RBAC->denyAccess();
                    }
                    
                }
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TotalFrequencia']))
		{
			$model->attributes=$_POST['TotalFrequencia'];
                        
                        $tmp=TotalFrequencia::model()->with('servidor')->findbyPk(array(
                            'ano'=>$model->ano,'mes'=>$model->mes,'servidor_cpf'=>$model->servidor_cpf));
                        
                        if(null==$tmp){
                           
                            if($model->save()){
                                
                                $this->addMessageSuccess("Frequência de ".Servidor::model()->findByPk($model->servidor_cpf)->nome." referente à $model->mes/$model->ano registrada com sucesso!");
                                $this->beginModel($model);
                            } 
                        }
                        else{
                            $this->addMessageErro("A Frequência de ".$model->servidor->nome." referente à $model->mes/$model->ano encontra-se registrada no sistema!");
                            $this->beginModel($model);
                        }
                    
                     //como cadastrou com sucesso ou já foi cadastrada, então limpa os dados
                    
		}
                
		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        private function beginModel($model){
            $model->unsetAttributes();
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
                //$this->_RBAC->checkAccess('manageTotalFrequencia',true);
		/*$dataProvider=new CActiveDataProvider('TotalFrequencia');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
                $this->redirect(array('admin'));
	}
        
        public function actionList()
	{
                $this->_RBAC->checkAccess('registered',true);
                $criteria=new CDbCriteria;

		$criteria->condition=" servidor_cpf=".Yii::app()->user->cpfservidor;
                
		$dataProvider=new CActiveDataProvider('TotalFrequencia', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                                      'pageSize'=>20
                        )
		));
                
		$this->render('list',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->_RBAC->checkAccess('manageTotalFrequencia',true);
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
