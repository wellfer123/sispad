<?php
class MetaController extends SISPADBaseController{
    public $layout='//layouts/column2';

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


        public function  actionCalculo(){
            $profissoes=array(
                              array('label'=>'Agente de Saúde','button'=>'Lançar Meta','action'=>''),
                              array('label'=>'Auxiliar de Enfermagem','button'=>'Lançar Meta','action'=>''),
                              array('label'=>'Enfermeiro','button'=>'Lançar Meta','action'=>''),
                              array('label'=>'Médico','button'=>'Lançar Meta','action'=>'MedicoExecutaMeta/calculeMetas'),
                              array('label'=>'Odontólogo','button'=>'Lançar Meta','action'=>'OdontologoExecutaMeta/calculeMetas'),
                              array('label'=>'Técnico em Enfermagem','button'=>'Lançar Meta','action'=>'')
            );
            
            $tiposMeta=array(Meta::ITENS=>'Meta de Itens',Meta::PROCEDIMENTO=>'Meta de Procedimentos');
           
            
            $this->render('calculo', array('profissoes'=>$profissoes,'tiposMeta'=>$tiposMeta,'competencias'=>CHtml::listData(Competencia::model()->findAll(), 'mes_ano', 'mes_ano')));
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
        public function actionDetails() {
            $model = $this->loadModel();
            $this->render('details',array(
			'model'=>$model,
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
            $profissao = $_GET['profissao'];
            if(isset($q)) {
                 $metas = Meta::model()->findAllBySql(Meta::getSelectSqlProfissao($profissao, strtoupper(trim($q)), Meta::ITENS));//(Meta::getCDbCriteriaProfissao(Medico::CODIGO_PROFISSAO, strtoupper(trim($q)), Meta::ITENS));
 
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
