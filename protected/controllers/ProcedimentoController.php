<?php
class ProcedimentoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	//private $_model;
        public function actions()
        {
        return array(
            'service'=>array(
                'class'=>'CWebServiceAction',
                'classMap'=>array(
                    'Procedimento'=>'Procedimento',
                    'Odontologo'=>'Odontologo',
                    'Medico'=>'Medico',
                    'Enfermeiro'=>'Enfermeiro',
                    'AgenteSaude'=>'AgenteSaude',
                    'UsuarioDesktop'=>'UsuarioDesktop',
                    'ServidorExecutaProcedimento'=>'ServidorExecutaProcedimento',
                    'EquipeExecutaProcedimento'=>'EquipeExecutaProcedimento',
                    'MedicoExecutaProcedimento'=>'MedicoExecutaProcedimento',
                    'EnfermeiroExecutaProcedimento'=>'EnfermeiroExecutaProcedimento',
                    'AgenteSaudeExecutaProcedimento'=>'AgenteSaudeExecutaProcedimento',
                    'OdontologoExecutaProcedimento'=>'OdontologoExecutaProcedimento',
                    'MessageWebService'=>'MessageWebService',
                ),
            ),
        );
    }    
    
    //todas os métodos do serviço
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function getLastMessages($usuarioDesktop){
       
       
        return array();
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function login($usuarioDesktop){
       
       
        return array();
    
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function logout($usuarioDesktop){
       
       
        return array();
    
    }
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Medico[]
     * @soap
     */
    public function getMedicos($codigoUnidade,$usuarioDesktop){
       
       
        return Medico::model()->findAll();
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return AgenteSaude[]
     * @soap
     */
    public function getAgenteSaude($codigoUnidade,$usuarioDesktop){
       
       
        return AgenteSaude::model()->findAll();
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Odontologo[]
     * @soap
     */
    public function getOdontologos($codigoUnidade,$usuarioDesktop){
       
       
        return Odontologo::model()->findAll();
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Enfermeiro[]
     * @soap
     */
    public function getEnfermeiros($codigoUnidade,$usuarioDesktop){
       
       
        return Enfermeiro::model()->findAll();
    }
    
    /**
     * @param ServidorExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorServidor($procedimentosExecutados,$usuarioDesktop){
       
       
        return array();
    }

   


    
    /**
     * @param EquipeExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorEquipe($procedimentosExecutados,$usuarioDesktop){
         
            $m= new MessageWebService;
        if(is_array($procedimentosExecutados)){
            foreach ($procedimentosExecutados as $proced) {
                try{
                $procedimento= new EquipeExecutaProcedimento;
                $procedimento->competencia=$proced->competencia;
                $procedimento->equipe_codigo_area=$proced->equipe_codigo_area;
                $procedimento->equipe_codigo_micro_area=$proced->equipe_codigo_micro_area;
                $procedimento->procedimento_codigo=$proced->procedimento_codigo;
                $procedimento->quantidade=$proced->quantidade;
                $procedimento->unidade_cnes=$proced->unidade_cnes;
                $procedimento->save();
                }  catch (Exception $e){
                    $m->valor="Falha no recebimento da competencia dados errdos".$e->getMessage();
                    return array($m);
                }
                
            }
            $m->valor="Recebida com sucesso";
            return array($m);
        }
        $m->valor="Falha no recebimento da competencia";
        return array($m);
    }
    
    /**
     * @param MedicoExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorMedico($procedimentosExecutados,$usuarioDesktop){
         
            $m= new MessageWebService;
        return array($m);
    }
    
    /**
     * @param EnfermeiroExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorEnfermeiro($procedimentosExecutados,$usuarioDesktop){
         
            $m= new MessageWebService;
        return array($m);
    }
    
    /**
     * @param OdontologoExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorOdontologo($procedimentosExecutados,$usuarioDesktop){
         
            $m= new MessageWebService;
        return array($m);
    }
    
    /**
     * @param AgenteSaudeExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorAgenteSaude($procedimentosExecutados,$usuarioDesktop){
         
            $m= new MessageWebService;
        return array($m);
    }
  
   
    
//
//	/**
//	 * @return array action filters
//	 */
//	public function filters()
//	{
//		return array(
//			'accessControl', // perform access control for CRUD operations
//		);
//	}
//
//	/**
//	 * Specifies the access control rules.
//	 * This method is used by the 'accessControl' filter.
//	 * @return array access control rules
//	 */
//	public function accessRules()
//	{
//		return array(
//		);
//	}
//
//	/**
//	 * Displays a particular model.
//	 */
//	public function actionView()
//	{
//		$this->render('view',array(
//			'model'=>$this->loadModel(),
//		));
//	}
//
//	/**
//	 * Creates a new model.
//	 * If creation is successful, the browser will be redirected to the 'view' page.
//	 */
//	public function actionCreate()
//	{
//		$model=new Procedimento;
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['Procedimento']))
//		{
//			$model->attributes=$_POST['Procedimento'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->codigo));
//		}
//
//		$this->render('create',array(
//			'model'=>$model,
//		));
//	}
//
//	/**
//	 * Updates a particular model.
//	 * If update is successful, the browser will be redirected to the 'view' page.
//	 */
//	public function actionUpdate()
//	{
//		$model=$this->loadModel();
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['Procedimento']))
//		{
//			$model->attributes=$_POST['Procedimento'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->codigo));
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//		));
//	}
//
//	/**
//	 * Deletes a particular model.
//	 * If deletion is successful, the browser will be redirected to the 'index' page.
//	 */
//	public function actionDelete()
//	{
//		if(Yii::app()->request->isPostRequest)
//		{
//			// we only allow deletion via POST request
//			$this->loadModel()->delete();
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_GET['ajax']))
//				$this->redirect(array('index'));
//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//	}
//
//	/**
//	 * Lists all models.
//	 */
//	public function actionIndex()
//	{
//		$dataProvider=new CActiveDataProvider('Procedimento');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
//	}
//
//	/**
//	 * Manages all models.
//	 */
//	public function actionAdmin()
//	{
//		$model=new Procedimento('search');
//		$model->unsetAttributes();  // clear any default values
//		if(isset($_GET['Procedimento']))
//			$model->attributes=$_GET['Procedimento'];
//
//		$this->render('admin',array(
//			'model'=>$model,
//		));
//	}
//
//	/**
//	 * Returns the data model based on the primary key given in the GET variable.
//	 * If the data model is not found, an HTTP exception will be raised.
//	 */
//	public function loadModel()
//	{
//		if($this->_model===null)
//		{
//			if(isset($_GET['id']))
//				$this->_model=Procedimento::model()->findbyPk($_GET['id']);
//			if($this->_model===null)
//				throw new CHttpException(404,'The requested page does not exist.');
//		}
//		return $this->_model;
//	}
//
//	/**
//	 * Performs the AJAX validation.
//	 * @param CModel the model to be validated
//	 */
//	protected function performAjaxValidation($model)
//	{
//		if(isset($_POST['ajax']) && $_POST['ajax']==='procedimento-form')
//		{
//			echo CActiveForm::validate($model);
//			Yii::app()->end();
//		}
//	}

     public function actionFindProcedimentos() {

            //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $procedimentos = Procedimento::model()->findAll('nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));

                if (!empty($procedimentos)) {
                    $out = array();
                    foreach ($procedimentos as $u) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $u->nome,
                            'value' => $u->nome,
                            'id' => $u->codigo, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }
}