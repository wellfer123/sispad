<?php

class ServidorController extends SISPADBaseController
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
	public function actionCreate()
	{
		$model=new Servidor('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Servidor']))
		{
			$model->attributes=$_POST['Servidor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cpf));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Servidor']))
		{
			$model->attributes=$_POST['Servidor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cpf));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionCreateAjax()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $data='errado';
		if(isset($_POST['Servidor']))
		{
			$model->attributes=$_POST['Servidor'];
			if($model->save()){
                            $data='certo';
                        }
		}

                echo CJSON::encode(array('cesar','65'));
                Yii::app()->end();
           
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Servidor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Servidor']))
			$model->attributes=$_GET['Servidor'];

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
				$this->_model=Servidor::model()->with('unidade','endereco.cidades')->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='servidor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionFindServidores() {
            
             $this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $servidores = Servidor::model()->findAll('nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
 
                if (!empty($servidores)) {
                    $out = array();
                    foreach ($servidores as $s) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $s->nome,  
                            'value' => $s->nome,
                            'id' => $s->cpf, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
    }
    
    public function actionFindMedicos() {
            
             //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $medicos = Medico::model()->with(array('servidor','unidade'))->findAll('servidor.nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
                //$servidores = Servidor::model()->findAllByAttributes(array('nome','cpf'),
                                             // 'where nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
 
                if (!empty($medicos)) {
                    $out = array();
                    foreach ($medicos as $med) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $med->getServidorUnidade(),  
                            'value' => $med->getServidorUnidade(),
                            'unidade_cnes' => $med->unidade_cnes,
                            'id' => $med->servidor_cpf, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }
   
   public function actionFindEnfermeiros() {
            
             //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $enfermeiros = Enfermeiro::model()->with(array('servidor','unidade'))->findAll('servidor.nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
                //$servidores = Servidor::model()->findAllByAttributes(array('nome','cpf'),
                                             // 'where nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
 
                if (!empty($enfermeiros)) {
                    $out = array();
                    foreach ($enfermeiros as $enf) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $enf->getServidorUnidade(),  
                            'value' => $enf->getServidorUnidade(),
                            'unidade_cnes' => $enf->unidade_cnes,
                            'id' => $enf->servidor_cpf, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }
   
   public function actionFindOdontologos() {
            
             //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $odontologos =  Odontologo::model()->with(array('servidor','unidade'))->findAll('servidor.nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
                //$servidores = Servidor::model()->findAllByAttributes(array('nome','cpf'),
                                             // 'where nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
 
                if (!empty($odontologos)) {
                    $out = array();
                    foreach ($odontologos as $odont) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $odont->getServidorUnidade(),  
                            'value' => $odont->getServidorUnidade(),
                            'unidade_cnes' => $odont->unidade_cnes,
                            'id' => $odont->servidor_cpf, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }
   
    public function actionFindAgentesDeSaude() {
            
             //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $agentes = AgenteSaude::model()->with(array('servidor','unidade'))->findAll('servidor.nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
                //$servidores = Servidor::model()->findAllByAttributes(array('nome','cpf'),
                                             // 'where nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
 
                if (!empty($agentes)) {
                    $out = array();
                    foreach ($agentes as $agen) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $agen->getServidorUnidade(),  
                            'value' => $agen->getServidorUnidade(),
                            'unidade_cnes' => $agen->unidade_cnes,
                            'micro_area'=>$agen->micro_area,
                            'agente_saude_micro_area'=>$agen->micro_area,
                            'id' => $agen->servidor_cpf, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }
   
    public function actionFindServidoresUsuarios() {
            
             $this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                $criteria= new CDbCriteria();
                $criteria->distinct=true;
                $criteria->alias="ser";
                $criteria->join=" INNER JOIN user us ON us.servidor_cpf=ser.cpf ";
                $criteria->condition='nome like :nome';
                $criteria->params=array(':nome'=> strtoupper(trim($q)).'%');
                 $servidores = Servidor::model()->findAll($criteria);
                //$servidores = Servidor::model()->findAllByAttributes(array('nome','cpf'),
                                             // 'where nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));
 
                if (!empty($servidores)) {
                    $out = array();
                    foreach ($servidores as $s) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $s->nome,  
                            'value' => $s->nome,
                            'id' => $s->cpf, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }
   /*public function actiontestepost(){
        sleep(2);
        if(isset($_POST)){
            //return the POST variable back
            //the widget will show an alert() with this data
            print_r($_POST);
            $set= new setor;
            $set->nome="teste";
            $set->departamento_id=1;
            $set->descricao="So testando rapaz";
            $set->save();
        }
    }*/
    
   protected function getModelName() {
       return 'Servidor';
   }

}
