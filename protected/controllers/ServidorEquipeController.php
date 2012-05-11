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
		$this->render('index');
	}

        protected function getModelName() {
            return 'ServidorEquipe';
        }
        public function actionAddToTeam()
	{

                $model = new ServidorEquipe;
                $model->equipe_codigo_area = $_GET['area'];
                $model->equipe_unidade_cnes = $_GET['cnes'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ServidorEquipe']))
		{

                        $model->servidor_cpf=$_POST['ServidorEquipe']['servidor_cpf'];
                       
                        if($model->save()){
                            $model = new ServidorEquipe();
                        }

		}

		$this->render('add_to_team',array(
			'model'=>$model,
		));
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