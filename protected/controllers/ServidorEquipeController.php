<?php

class ServidorEquipeController extends SISPADBaseController
{
    public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;


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

	public function actionIndex()
	{
                $model = new ServidorEquipe;
		$this->render('admin_members',array('model'=>$model));
	}

        protected function getModelName() {
            return 'ServidorEquipe';
        }
        public function actionAddToTeam()
	{

                $model = new ServidorEquipe('create');
                $model->equipe_codigo_area = $_GET['area'];
                $model->equipe_unidade_cnes = $_GET['cnes'];

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ServidorEquipe']))
		{

                        $model->servidor_cpf=$_POST['ServidorEquipe']['servidor_cpf'];
                        $model->funcao = $_POST['ServidorEquipe']['funcao'];
                        $model->ativo = 1;

                        $model2 = new $model->funcao;
                        $model2->servidor_cpf = $model->servidor_cpf;
                        $model2->unidade_cnes = $model->equipe_unidade_cnes;
                        $model2->data_cadastro = date("Y-m-d");
                        $model2->ativo=1;
                       
                        if(($model->save())){
                            if($model2->save()){
                                $model = new ServidorEquipe('create');
                                $model2=null;
                            }
                            
                        }

		}

		$this->render('add_to_team',array(
			'model'=>$model,
		));
	}

        public function actionAdminMembers(){
                //$this->CheckAcessAction();
		$model=new ServidorEquipe();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['codigo_area']) && isset($_GET['unidade_cnes']))
			$model->equipe_codigo_area = $_GET['codigo_area'];
                         $model->equipe_unidade_cnes = $_GET['unidade_cnes'];

		$this->render('admin_members',array(
			'model'=>$model,
		));
        }

        public function actionActive()
	{
                //$this->CheckAcessAction();
		if(Yii::app()->request->isPostRequest)
		{
                   
			// we only allow deletion via POST request
                        $mo=$this->loadModel();
                        $mo->scenario = 'active';
                        if($mo!=null){
                            $mo->ativo=ServidorEquipe::ATIVO;
                            if($mo->save()){
                                
                            }else{
                                throw new CHttpException(500,$mo->erro);
                            }
                          
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


        public function actionInactive()
	{
                //$this->CheckAcessAction();
		if(Yii::app()->request->isPostRequest)
		{

			// we only allow  via POST request
			$mo=$this->loadModel();
                        if($mo!=null){
                            
                            $mo->ativo=ServidorEquipe::DESATIVO;
                            
                            $mo->save();
                              
                            
                            
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
			if(isset($_GET['codigo_area'],$_GET['unidade_cnes'],$_GET['servidor_cpf'])){
                            
				$this->_model=ServidorEquipe::model()->with('servidor')->findbyPk(
                                        array('equipe_codigo_area'=>$_GET['codigo_area'],'equipe_unidade_cnes'=>$_GET['unidade_cnes'],
                                            'servidor_cpf'=>$_GET['servidor_cpf']));

                                            }
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='servidorEquipe-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	// -----------------------------------------------------------
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}