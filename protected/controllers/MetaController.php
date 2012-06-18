<?php
class MetaController extends SISPADBaseController{
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


        public function actionCreate() {
             //$this->CheckAcessAction();
                $model=new Meta();



		//Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if((isset($_POST['Meta'])) && (isset($_GET['indicador_id'])))
		{

                        $model->attributes=$_POST['Meta'];
                        $model->indicador_id=$_GET['indicador_id'];
			if($model->save()){
                            $this->addMessageSuccess("Meta criada!");
                                  $model=new Meta;
                        }

                }

		$this->render('create',array(
			'model'=>$model
		));

        }

        public function actionView() {
            $model = new Meta();
            $this->render('view',array(
			'model'=>$model,
		));

        }
        
       

    protected function getModelName() {
        return 'Meta';
    }
    
    public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Meta::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


     protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='meta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
       public function actionFindMetas() {
            
             $this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                Meta::
                 $metas = Meta::model()->findAll(Meta::getCDbCriteriaProfissao(Medico::CODIGO_PROFISSAO, strtoupper(trim($q)), Meta::ITENS));
 
                if (!empty($metas)) {
                    $out = array();
                    foreach ($metas as $met) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $met->nome,  
                            'value' => $met->nome,
                            'id' => $met->id, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
    }
}
?>
