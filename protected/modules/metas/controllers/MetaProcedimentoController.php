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
        
        //metodo validador que verifica se a profissao do procedimento corresponde a profissao do indicador
        public function validaProcedimentoComIndicador($profissaoCodigo) {
          $model= new MetaProcedimento;
          
          
          if($profissaoCodigo!=null){ 
             if(isset($_GET['indicador_id'])){
                $id = $_GET['indicador_id'];
                $indicador = Indicador::model()->findByPk($id);
               
                if($indicador->profissao_codigo!=$profissaoCodigo){
                     $this->addMessageErro('Procedimento de Agente de Saude não pode estar em outro tipo de indicador');
                     return false;
                }else{
                    return true;
                }
              }
            }
            return true;
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
                        $procedimento = Procedimento::model()->findByPk($model->procedimento_codigo);
                        
                        if($this->validaProcedimentoComIndicador($procedimento->codigo_profissao)){
                        
                        $model->meta_id=$_GET['meta_id'];
			if($model->save()){
                            $model=new MetaProcedimento;
                            $this->addMessageSuccess("Procedimento adicionado a meta!");

                        }
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