<?php

class MetaProcedimentoController extends SISPADBaseController
{

         public $layout='//layouts/column1';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;



        public function __construct($id, $module = null) {
            parent::__construct($id, $module);
        }

        public function filters()
	{
		return array(
			'accessControl',
		);
	}

        protected function getModelName() {
            'MetaProcedimento';
        }
	public function actionIndex()
	{
		$this->render('index');
	}

        public function actionView() {
            $model = new MetaProcedimento();
            $this->render('view',array('model'=>$model));
        }

         public function actionAdd()
	{
                //$this->CheckAcessAction();
                $model=new MetaProcedimento;



		//Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if((isset($_POST['MetaProcedimento']))&&(isset($_GET['meta_id'])))
		{

                        $model->procedimento_codigo=$_POST['MetaProcedimento']['procedimento_codigo'];
                        $model->meta_id=$_GET['meta_id'];
			if($model->save()){
                            $model=new MetaProcedimento;
                            $this->addMessageSuccess("Procedimento adicionado a meta!");

                        }

                }

		$this->render('add',array(
			'model'=>$model
		));
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
        
         protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='metaProcedimento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}