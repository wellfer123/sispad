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
    
        //vai guardar o valor da competencia anterior
        private $competencia_old;
        //vai guardar um true ou false se a competencia anterior é válida
        private $competencia_boolean;
        
        //vai guardar o valor da competencia anterior
        private $servidor_equipe_old;
        //vai guardar um true ou false se a competencia anterior é válida
        private $servidor_equipe_boolean;
        
        
        public function actions()
        {
        return array(
            'service'=>array(
                'class'=>'CWebServiceAction',
                'classMap'=>array(
                    'Procedimento'=>'Procedimento',
                    'Unidade'=>'Unidade',
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
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosAEnviarSIAB($usuarioDesktop){
       
       
        return Procedimento::model()->findAll();
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosAEnviarSIA($usuarioDesktop){
       
       
        return Procedimento::model()->findAll();
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Unidade[]
     * @soap
     */
    public function getUnidades($usuarioDesktop){
       
       
        return Procedimento::model()->findAll();
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @param Unidade[]
     * @return MessageWebService[]
     * @soap
     */
    public function validarUnidades($usuarioDesktop,$unidades){
       
       
        return array();
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
        try{
            //arreio de mensagens
            $msg=array();
            $this->iniciarVariaveisGlobais();
            // verifica se o usuário está logado
            if($this->usuarioEstaLogado($usuarioDesktop)){
                //verifica se é um vetor de procedimentos executados por medicos
                if(is_array($procedimentosExecutados)){
                    foreach($procedimentosExecutados as $proc){
                        
                        $medExe= new MedicoExecutaProcedimento();
                        $compet= new Competencia();
                        //vai preencher os dados
                        $medExe->setCompetencia($proc->competencia);
                        $medExe->setMedico_cpf($proc->medico_cpf);
                        $medExe->setMedico_unidade_cnes($proc->medico_unidade_cnes);
                        $medExe->setProcedimento_codigo($proc->procedimento_codigo);
                        $medExe->setQuantidade($proc->quantidade);
                        //carrega as entidades para usar nas mensagens
                        $ser= $this->loadServidor($proc->medico_cpf);
                        $procedi=$this->loadProcedimento($proc->procedimento_codigo);
                        
                        $compet->setMesAno($medExe->getCompetencia());
                        //verifica se a competencia do procedimento executado é válida
                        if($this->validarCompetencia($compet)){
                            //é válida, então deve verificar se o servidor pertence mesmo a equipe
                            $servidor_equipe= new ServidorEquipe;
                            //preenchendo so valores
                            $servidor_equipe->setServidorCPF($medExe->getMedico_cpf());
                            $servidor_equipe->setEquipeUnidadeCNES($medExe->getMedico_unidade_cnes());
                            $servidor_equipe->setFuncao("Medico");
                            if($this->IsServidorEquipe($servidor_equipe)){
                                //agora verifica se o registro já existe, senão existir, vai cadastrar
                               
                                if($this->validarProcedimentoExecutadomedico($medExe)){
                                   //vai salvar o registro
                                    try{
                                        //vai salvar o objeto
                                        if($medExe->save()){
                                               $sucesso=new MessageWebService();
                                               $sucesso->setCodigo(MessageWebService::$SUCESSO);
                                               $sucesso->setMessage("PROCEDIMENTO: $procedi->nome \nMÉDICO: $ser->nome \nSUCESSO: PROCEDIMENTO EXECUTADO PELO MÉDICO REGISTRADO COM SUCESSO");
                                               $msg[]=$sucesso;
                                        }
                                        //erro ao salvar
                                        else{
                                            $erro=new MessageWebService();
                                            $erro->setCodigo(MessageWebService::$ERRO);
                                            $erro->setMessage("PROCEDIMENTO: $procedi->nome \nMÉDICO: $ser->nome \nERRO: NÃO FOI POSSÍVEL REGISTRAR O PROCEDIMENTO EXECUTADO PELO MÉDICO");
                                            //$medExe->geter
                                            //adiciona o erro ao vetor
                                            $msg[]=$erro;
                                        }
                                    }catch(Exception $ex){
                                        $tmp=$ex->getMessage();
                                        $erro=new MessageWebService();
                                        $erro->setCodigo(MessageWebService::$ERRO);
                                        $erro->setMessage("PROCEDIMENTO: $procedi->nome \nMÉDICO: $ser->nome \nERRO INESPERADO AO TENTAR SALVAR O PROCEDIMENTO EXECUTADO PELO MÉDICO! $tmp");
                                        //adiciona o erro ao vetor
                                        $msg[]=$erro;
                                    } 
                                    //terminou o try
                                }
                                //já foi enviado
                                else{
                                   $erro=new MessageWebService();
                                   $erro->setCodigo(MessageWebService::$ERRO);
                                   $erro->setMessage("PROCEDIMENTO: $procedi->nome \nMÉDICO: $ser->nome \nERRO: JÁ FOI ENVIADO PARA A COMPETÊNCIA $medExe->competencia");
                                   $msg[]=$erro; 
                                }
                            }
                            //médico não faz parte da equipe
                            else{
                               $erro=new MessageWebService();
                               $erro->setCodigo(MessageWebService::$ERRO);
                               $erro->setMessage("MÉDICO: $ser->nome \nERRO: NÃO ESTÁ CADASTRADO EM NENHUMA EQUIPE");
                               $msg[]=$erro; 
                            }
                        }
                        //competência inválida
                        else{
                            $erro=new MessageWebService();
                            $erro->setCodigo(MessageWebService::$ERRO);
                            $erro->setMessage("ERRO: COMPETÊNCIA INVÁLIDA, $medExe->competencia");
                            $msg[]=$erro;
                        }
                        
                    }
                }
                //não foi um array de procedimentos executados por medicos
                else{
                    $erro=new MessageWebService();
                    $erro->setCodigo(MessageWebService::$ERRO);
                    $erro->setMessage("ERRO: DEVE-SE ENVIAR UMA LISTA DE PROCEDIMENTOS EXECUTADOS POR UM MÉDICO!");
                    //adiciona o erro ao vetor
                    $msg[]=$erro;
                    
                }
            }
            //não está logado
            else{
                $erro=new MessageWebService();
                $erro->setCodigo(MessageWebService::$ERRO);
                $erro->setMessage("ERRO: DEVE-SE FAZER LOGIN NO WEB SERVICE!");
                //adiciona o erro ao vetor
                $msg[]=$erro;
            }
        }catch(Exception $ex){
            $tmp=$ex->getMessage();
            $erro=new MessageWebService();
            $erro->setCodigo(MessageWebService::$ERRO);
            $erro->setMessage("ERRO INESPERADO A CHAMADA DO MÉTODO! $tmp");
            //adiciona o erro ao vetor
            $msg[]=$erro;
        }
        return $msg;
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
  
   //métodos privados
    
   private function iniciarVariaveisGlobais(){
       $this->competencia_boolean=false;
       $this->competencia_old=-9999999;
       $this->servidor_equipe_boolean=false;
       $this->servidor_equipe_old=null;
   }
   private function validarCompetencia($competencia){
       /*if($competencia->equals($competencia)){
           if($this->competencia_boolean){
               return true;
           }
       }
       $this->competencia_old=$competencia;
       $this->competencia_boolean=Competencia::model()->exists("mes_ano=:valor AND ativo=:ativo",
                                                                array(
                                                                    ':valor'=>$competencia->mes_ano,
                                                                    ':ativo'=>  Competencia::ABERTA
                                                                ));
       return $this->competencia_boolean;*/
    return true;
   }
   
   private function IsServidorEquipe($servidor_equipe){
       if($servidor_equipe->equals($this->servidor_equipe_old)){
           if($this->servidor_equipe_boolean){
               return true;
           }
       }
       //o servidorEquipe e diferente ou não foi válido o anterior
       $this->servidor_equipe_old=$servidor_equipe;
       $this->servidor_equipe_boolean=ServidorEquipe::model()->exists(" servidor_cpf=:servidor AND equipe_unidade_cnes=:cnes AND funcao=:funcao AND ativo=:ativo",
                                                array(
                                                        ':servidor'=>$servidor_equipe->servidor_cpf,
                                                        ':cnes'=>$servidor_equipe->equipe_unidade_cnes,
                                                        ':funcao'=>$servidor_equipe->funcao,
                                                        ':ativo'=>ServidorEquipe::ATIVO
                                                ));
       return $this->servidor_equipe_boolean;
   }
   
   private function validarProcedimentoExecutadomedico($medicoExecutaProcedimento){
       //se existir vai retornar falso
       return !$medicoExecutaProcedimento->exists("medico_cpf=:medico AND procedimento_codigo=:procedimento
                               AND medico_unidade_cnes=:unidade AND competencia=:competencia",
                               array(':medico'=>$medicoExecutaProcedimento->getMedico_cpf(),
                                    ':procedimento'=>$medicoExecutaProcedimento->getProcedimento_codigo(),
                                    ':unidade'=>$medicoExecutaProcedimento->getMedico_unidade_cnes(),
                                    ':competencia'=>$medicoExecutaProcedimento->getCompetencia()
                                    )
                               );
   }


   private function existeProcedimento($metaProcedimento){
       return true;//Procedimento::model()->exists("codigo=:codigo",array(':codigo'=>));
   }


   private function usuarioEstaLogado($usuarioDesktop){
       return true;
   }
   
   private function logarUsuario($usuarioDesktop){
       return true;
   }
   
   private function deslogarUsuario($usuarioDesktop){
       return true;
   }
   
   private function loadServidor($cpf){
       return Servidor::model()->findByPk($cpf);
   }
   
   private function loadProcedimento($codigo_procedi){
       return Procedimento::model()->findByPk($codigo_procedi);
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