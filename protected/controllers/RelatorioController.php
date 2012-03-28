

<?php
Yii::import('application.modules.rbac.components.*');
Yii::import('application.services.FormataData');
class RelatorioController extends SISPADBaseController
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
				'actions'=>array('index','view','display'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
                $this->_RBAC->checkAccess('register');
                $model=$this->loadModel();
                $model->data_trabalho=FormataData::inverteData($model->data_trabalho,"-");
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
                $this->_RBAC->checkAccess('manage',true);
		$model=new relatorio;
                $model->arquivo=new Arquivo();
                $model->servidor_cpf=Yii::app()->user->cpfservidor;
                //configura um cenario para o modelo, desse modo pode-se validar apenas essa actions 
                $model->scenario='create';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['relatorio']))
		{
                           
                            $model->data_trabalho=$_POST['relatorio']['data_trabalho'];
                            $model->data_envio = date('Y/m/d  H:i:s');
                            $model->servidor_cpf=Yii::app()->user->cpfservidor;//$_POST['relatorio']['servidor_cpf'];
                          
                            if($model->save()){
                               if($model->salvaArquivo()){
                                  $this->addMessageSuccess("Relatorio Cadastrado com sucesso");
                                  $model=new relatorio;
                                  $model->arquivo=new Arquivo();
                                  $model->servidor_cpf=Yii::app()->user->cpfservidor;
                              }
                            }
                }

		$this->render('create',array(
			'model'=>$model
		));
        }

       


       public function  validaRelatorioExistente($data_trabalho){

             if(relatorio::model()->find(array('data_trabalho'=>$data_trabalho))){
                 return true;
             }
             return false;
        }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
                $model=$this->loadModel();


                $data_hoje=date("Y-m-d");
                $dias=FormataData::calculaDiferencaDatas($data_hoje,$model->data_envio, null, "-");
                $params=array("dias"=>$dias);

                $this->_RBAC->checkAccessByData('updateRelatorio',$params,true);
		
                $model->data_trabalho=  FormataData::inverteData($model->data_trabalho, "-");
                $model->arquivo=$model->temp_arquivo;
                //$this->formataDataDeTrabalho($model);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Arquivo']))
		{
                   
			//$model->attributes=$_POST['relatorio'];
                        //$model->data_trabalho=  FormataData::inverteData($model->data_trabalho, "/");
                        //$this->formataDataDeTrabalho($model);
			//if($model->save())
                        
                        if($model->atualizaArquivo())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

         public function formataDataDeTrabalho($model){
            $dataarray = explode('-',$model->data_trabalho);
            $model->data_trabalho = $dataarray[2] . '/' . $dataarray[1] . '/' . $dataarray[0];

        }


        public function actionDisplay()
        {
          
            $model=$this->loadModel($_GET['id']);

                header('Pragma: public');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Content-Transfer-Encoding: binary');
                header('Content-length: '.$model->temp_arquivo->file_size);
                header('Content-Type: '.$model->temp_arquivo->file_type);
                header('Content-Disposition: attachment; filename='.$model->temp_arquivo->file_name);
                die($model->temp_arquivo->file_data);
            //echo $model->file_data;
}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
                $this->_RBAC->checkAccess('deleteRelatorio',true);
                //$this->_RBAC->denyAccess();
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
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()

	{
            $this->_RBAC->checkAccess('manage',true);
            $model=new relatorio('search');
		$dataProvider=new CActiveDataProvider('relatorio');
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->_RBAC->checkAccess('manage',true);
		$model=new relatorio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['relatorio']))
			$model->attributes=$_GET['relatorio'];

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
				$this->_model=relatorio::model()->with('temp_arquivo')->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

         private function beginModel($model){
           $model->data_trabalho=null;
           $model->file_data=null;
            //inicia os dados

        }
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='relatorio-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}




