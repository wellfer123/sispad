<?php

class EnderecoController extends SISPADBaseController
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
           if(isset($_GET['id']) && isset($_GET['model']) && isset($_GET['idModel'])){
         
                //tem os parãmetros necessários
		$model=new Endereco;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Endereco']))
		{
			$model->attributes=$_POST['Endereco'];
			if($model->save()){
                            $this->redirectViewModel($model);
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
           }
           //nao tem os parâmetros necessários
           else{
               throw new CHttpException(404,'Você acessou indevidamente uma página! Não repita a operção!');
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
        
        public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id'])){
				$this->_model=Endereco::model()->with('cidade')->findbyPk($_GET['id']);
                                if($this->_model===null){
                                    $this->redirect(array('create','id'=>$_GET['id'],'model'=>$_GET['model'],'idModel'=>$_GET['idModel'])); 
                                }
                        }
			else {
				throw new CHttpException(404,'Servidor não existente no sistema.');
                        }
		}
		return $this->_model;
	}
        
        protected function redirectViewModel($model){
                //vai verificar qual foi a entidade que está solicitando um endereco
                            $ent=$_GET['model'];
                            $id=$_GET['idModel'];
                            switch($ent){
                                case 'servidor':
                                                $ser=Servidor::model()->findByPk($id);
                                                //coloca o id do endereco no servidor
                                                $ser->endereco_id=$model->id;
                                                //salvar o servidor
                                                $ser->save();
                                                break;
                            }
                            $this->redirect(array("view",'id'=>$_GET['id'],'model'=>$_GET['model'],'idModel'=>$_GET['serv']));
        }

    protected function getModelName() {
        return 'Endereco';
    }
}
