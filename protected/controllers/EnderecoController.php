<?php

class EnderecoController  extends SISPADBaseController
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

         public function __construct($id, $module = null) {
            parent::__construct($id, $module);
        }
        protected function getModelName() {
            return 'Endereco';
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
         
                //tem os parãmetros necessários
		$model=new Endereco;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Endereco']))
		{
			$model->attributes=$_POST['Endereco'];
			if($model->save())
                                $this->salvaEmServidor($model);
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        public function salvaEmServidor($model) {
            
            $servidor =$this->loadModelServidor();
            
            $servidor->endereco_id = $model->id;
            
            if($servidor->save()){
              $this->redirect(array('view','id'=>$model->id));
            }else{
                $this->addmessageErro("Erro ao cadastrar o endereço: verifique se os dados do servidor foram
                    cadastrados corretamente");
            }
        }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
            if(isset($_GET['id']) && isset($_GET['model']) && isset($_GET['idModel'])){
		$model=Endereco::model()->findByPk($_GET['id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Endereco']))
		{
			$model->attributes=$_POST['Endereco'];
			if($model->save())
				$this->redirectViewModel($model);
		}

		$this->render('update',array(
			'model'=>$model,
		));
            } else{
                throw new CHttpException(404,'Você acessou indevidamente uma página! Não repita a operção!');
            }
	}

        public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
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
				$this->_model=Endereco::model()->findbyPk($_GET['id']);
			if($this->_model===null)
                                 $this->redirect(array('create','cpf'=>$_GET['cpf']));
				//throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

        public function loadModelServidor()
	{

		if(isset($_GET['cpf']))
                    $modelServidor=Servidor::model()->findbyPk($_GET['cpf']);
                

		return $modelServidor;
	}


        
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='endereco-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
