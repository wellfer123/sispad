<?php

class TotalRelatorioController extends SISPADBaseController
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
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
                if(isset($_GET['serv'])){
                    //se or o dono das frequencias ou se for o gerenciador
                    if($_GET['serv']==Yii::app()->user->cpfservidor || 
                            $this->_RBAC->checkAccess('viewTotalRelatorio')){
                        
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
                 $this->CheckAcessAction();
		$model=new TotalRelatorio;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TotalRelatorio']))
		{
			$model->attributes=$_POST['TotalRelatorio'];
			$tmp=TotalRelatorio::model()->with('servidor')->findbyPk(array(
                            'ano'=>$model->ano,'mes'=>$model->mes,'servidor_cpf'=>$model->servidor_cpf));
                        
                        if(null==$tmp){
                           
                            if($model->save()){
                                
                                $this->addMessageSuccess("Quantidade de relatórios de ".Servidor::model()->findByPk($model->servidor_cpf)->nome." referente à $model->mes/$model->ano registrada com sucesso!");
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

		if(isset($_POST['TotalRelatorio']))
		{
			$model->attributes=$_POST['TotalRelatorio'];
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
		$this->redirect(array('admin'));
	}
        
        public function actionList()
	{
                $this->CheckAcessAction();
                $criteria=new CDbCriteria;

		$criteria->condition=" servidor_cpf=".Yii::app()->user->cpfservidor;
                
		$dataProvider=new CActiveDataProvider('TotalRelatorio', array(
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
                $this->CheckAcessAction();
		$model=new TotalRelatorio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TotalRelatorio']))
			$model->attributes=$_GET['TotalRelatorio'];

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
				$this->_model=  TotalRelatorio::model()->with('servidor')->findbyPk(array('ano'=>$_GET['ano'],'mes'=>$_GET['mes'],'servidor_cpf'=>$_GET['serv']));
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='total-relatorio-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        protected function getModelName() {
            return 'TotalRelatorio';
        }

}
