<?php

class ServidorExecutaItemController extends SISPADBaseController
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
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSend()
	{
		$model=new ServidorExecutaItem('send');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ServidorExecutaItem']))
		{
			$model->attributes=$_POST['ServidorExecutaItem'];
			if($model->save())
				$this->redirect(array('view',
                                            'item'=>$model->item_id,
                                            'servidor'=>$model->servidor_cpf,
                                            'data_inicio'=>$model->data_inicio,
                                            'data_fim'=>$model->data_fim
                                ));
		}

		$this->render('send',array(
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
			if(isset($_GET['servidor']))
				$this->_model=ServidorExecutaItem::model()->with('servidor','item')->findbyPk(array(
                                                                    'servidor_cpf'=>$_GET['servidor'],
                                                                    'item_id'=>$_GET['item'],
                                                                    'data_inicio'=>$_GET['data_inicio'],
                                                                    'data_fim'=>$_GET['data_fim'],
                                ));
			if($this->_model===null)
				throw new CHttpException(404,'O item executado que você pediu visualização não foi encontrado');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='servidor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
     
   protected function getModelName() {
       return 'Servidor';
   }

}
