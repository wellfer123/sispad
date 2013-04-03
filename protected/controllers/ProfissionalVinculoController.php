<?php

class ProfissionalVinculoController extends SISPADBaseController
{       
    
    public $layout = '//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    
    /**
        * @var CActiveRecord the currently loaded data model instance.
        */
    private $_model;


    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }
        
        
    protected function getModelName() {
        return 'ProfissaoVinculo';
    }
	public function actionIndex()
	{
		$this->render('index');
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
	public function actionCreate()
	{
		$model=new ProfissionalVinculo('create');
                $servidor = $this->getServidor();
                $model->unidade_cnes = $servidor->unidade->cnes;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProfissionalVinculo']))
		{
			$model->attributes=$_POST['ProfissionalVinculo'];
			if($model->save())
				$this->redirect(array('create'));
		}
                $dataProvider = $this->getAllProfissionaisUnidade();
		$this->render('create',array('dataProvider'=>$dataProvider,'model'=>$model,'unidade'=> $servidor->unidade->nome));
	}
        
        public function getAllProfissionaisUnidade(){
            $criteria=new CDbCriteria;
            $servidor = $this->getServidor();
            $criteria->condition=" unidade_cnes=".$servidor->unidade->cnes;
            $dataProvider=new CActiveDataProvider('ProfissionalVinculo', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                                      'pageSize'=>20
                        )
		));
            return $dataProvider;
            
        }
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