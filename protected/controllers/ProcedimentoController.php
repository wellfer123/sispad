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
        $msg=array();
       if($usuarioDesktop!=null){
           $user=  User::model()->find('servidor_cpf=:cpf AND username=:user', 
                                        array(':cpf'=>$usuarioDesktop->servidor_cpf,':user'=>$usuarioDesktop->usuario_sistema));
           $userDesk= UsuarioDesktop::model()->find('servidor_cpf=:cpf AND token=:token AND serial_aplicacao=:serial',
                                                array(':cpf'=>$usuarioDesktop->servidor_cpf,':token'=>$usuarioDesktop->token,':serial'=>$usuarioDesktop->serial_aplicacao));
           if($user===null){
               //não existe um usuário para o sistema
               $msg[]=$this->getMessageWebService("NÃO EXISTE O USUÁRIO $usuarioDesktop->usuario_sistema COM CPF: $usuarioDesktop->servidor_cpf CADASTRADO EM NOSSO SSITEMA", MessageWebService::ERRO);
           }
           //tem o usuário para o sistema, mas não tem acesso a aplicações
           elseif($userDesk===null){
               $msg[]=$this->getMessageWebService("O USUÁRIO $usuarioDesktop->usuario_sistema NÃO TEM ACESSO ÀS APLICAÇÕES DESKTOPS", MessageWebService::ERRO);
           }
           elseif($userDesk->serial_aplicacao!==$usuarioDesktop->serial_aplicacao){
               $msg[]=$this->getMessageWebService("O USUÁRIO $usuarioDesktop->usuario_sistema NÃO TEM ACESSO À APLICAÇÃO COM SERIAL $usuarioDesktop->serial_aplicacao.", MessageWebService::ERRO);
           }
           elseif($userDesk->token!==$usuarioDesktop->token){
               $msg[]=$this->getMessageWebService("O USUÁRIO $usuarioDesktop->usuario_sistema NÃO TEM TOKEN VÁLIDO PARA A APLICAÇÃO COM SERIAL $usuarioDesktop->serial_aplicacao.", MessageWebService::ERRO);
           }
           else{
               $usuario= new UsuarioDesktopLogado;
               $usuario->usuario_aplicacao=$userDesk->serial_aplicacao;
               $usuario->usuario_desktop_cpf=$userDesk->servidor_cpf;
               $usuario->usuario_token=$userDesk->token;
               if($usuario->save()){
                  $msg[]=$this->getMessageWebService("O USUÁRIO $usuarioDesktop->usuario_sistema LOGADO COM SUCESSO NO SISPAD", MessageWebService::SUCESSO); 
               }
               else{
                  $msg[]=$this->getMessageWebService("NÃO FOI POSSÍVEL LOGAR O USUÁRIO $usuarioDesktop->usuario_sistema NO SISPAD", MessageWebService::ERRO); 
               }
           }

       }
       else{
           $msg=$this->getMessageWebService("USUÁRIO DESKTOP INVÁLIDO", MessageWebService::ERRO);
       }
        return $msg;
    
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
        if($codigoUnidade==null){
            return Medico::model()->findAll();
        }
       
        return Medico::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosAEnviarSIAB($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimento(Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeMedicoAEnviarSIAB($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorprofissional('690', Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeEnfermeiroAEnviarSIAB($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorprofissional('532', Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeOdontologoAEnviarSIAB($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorprofissional('717', Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeAgenteSaudeAEnviarSIAB($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorprofissional('106', Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosAEnviarSIA($usuarioDesktop){
       
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimento(Procedimento::ORIGEM_SIA));;
    }
    
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeMedicoAEnviarSIA($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorprofissional('690', Procedimento::ORIGEM_SIA));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeEnfermeiroAEnviarSIA($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorprofissional('532', Procedimento::ORIGEM_SIA));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeOdontologoAEnviarSIA($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorprofissional('717', Procedimento::ORIGEM_SIA));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeAgenteSaudeAEnviarSIA($usuarioDesktop){
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorprofissional('106', Procedimento::ORIGEM_SIA));
    }
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Unidade[]
     * @soap
     */
    public function getUnidades($usuarioDesktop){
       
       
        return Unidade::model()->findAll();
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @param Unidade[]
     * @return MessageWebService[]
     * @soap
     */
    public function validarUnidades($usuarioDesktop,$unidades){
       
        if(is_array($unidades)){
            //monta a consulta
        }
        return array();
    }
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return AgenteSaude[]
     * @soap
     */
    public function getAgenteSaude($codigoUnidade,$usuarioDesktop){
       
       
        return AgenteSaude::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));;
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Odontologo[]
     * @soap
     */
    public function getOdontologos($codigoUnidade,$usuarioDesktop){
       
       
        return Odontologo::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Enfermeiro[]
     * @soap
     */
    public function getEnfermeiros($codigoUnidade,$usuarioDesktop){
       
       
        return Enfermeiro::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));;
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
                                if($this->existeProcedimento($medExe->getProcedimento_codigo())){
                                    //agora verifica se o registro já existe, senão existir, vai cadastrar
                                    if($this->validarProcedimentoExecutadomedico($medExe)){
                                        //vai salvar o registro
                                        try{
                                            //vai salvar o objeto
                                            if($medExe->save()){
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nMÉDICO: $ser->nome \nSUCESSO: PROCEDIMENTO EXECUTADO PELO MÉDICO REGISTRADO COM SUCESSO", MessageWebService::SUCESSO); 
                                            }
                                            //erro ao salvar
                                            else{
                                                //adiciona o erro ao vetor
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nMÉDICO: $ser->nome \nERRO: NÃO FOI POSSÍVEL REGISTRAR O PROCEDIMENTO EXECUTADO PELO MÉDICO", MessageWebService::ERRO);
                                            }
                                        }catch(Exception $ex){
                                            $tmp=$ex->getMessage();
                                            //adiciona o erro ao vetor
                                            $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nMÉDICO: $ser->nome \nERRO INESPERADO AO TENTAR SALVAR O PROCEDIMENTO EXECUTADO PELO MÉDICO! $tmp", MessageWebService::ERRO); 
                                        } 
                                        //terminou o try
                                    }
                                    //já foi enviado
                                    else{
                                        $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nMÉDICO: $ser->nome \nERRO: JÁ FOI ENVIADO PARA A COMPETÊNCIA $medExe->competencia", MessageWebService::ERRO); 
                                    }
                                }
                                //o rpocedimento não faz parte de nenhuma meta
                                else{
                                   $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome\n WARNING: NÃO FAZ PARTE DE NHUMA META. ENTÃO FOI DESCARTADO!", MessageWebService::WARNING); 
                                }
                            }
                            //médico não faz parte da equipe
                            else{
                               $msg[]=$this->getMessageWebService("MÉDICO: $ser->nome \nERRO: NÃO ESTÁ CADASTRADO EM NENHUMA EQUIPE", MessageWebService::ERRO); 
                            }
                        }
                        //competência inválida
                        else{
                            $msg[]=$this->getMessageWebService("ERRO: COMPETÊNCIA INVÁLIDA, $medExe->competencia", MessageWebService::ERRO);
                        }
                        
                    }
                }
                //não foi um array de procedimentos executados por medicos
                else{
                    //adiciona o erro ao vetor
                    $msg[]=$this->getMessageWebService("ERRO: DEVE-SE ENVIAR UMA LISTA DE PROCEDIMENTOS EXECUTADOS POR UM MÉDICO!", MessageWebService::ERRO);
                    
                }
            }
            //não está logado
            else{
                $msg[]=$this->getMessageWebService("ERRO: DEVE-SE FAZER LOGIN NO WEB SERVICE!", MessageWebService::ERRO);
            }
        }catch(Exception $ex){
            $tmp=$ex->getMessage();
            $msg[]=$this->getMessageWebService("ERRO INESPERADO A CHAMADA DO MÉTODO! $tmp",MessageWebService::ERRO);
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
   //devolve uma CDBcriteria para consultar os procedimentos que fazem da parte de alguma meta  e
   private function getCDBcriteriaProcedimento($origemProcedimento){
        $criteria= new CDbCriteria();
        $criteria->select="codigo, nome";
        $criteria->distinct=true;
        $criteria->join="INNER JOIN meta_procedimento ON codigo=procedimento_codigo";
        $criteria->condition="origem=:origem";
        $criteria->params=array(':origem'=>$origemProcedimento);
       return $criteria;
   }
   
   //devolve uma CDBcriteria para consultar os procedimentos que fazem da parte de alguma meta  e
   private function getCDBcriteriaProcedimentoPorprofissional($codigoFuncao, $origemProcedimento){
        $criteria= new CDbCriteria();
        $criteria->select=" pro.codigo, pro.nome";
        $criteria->distinct=true;
        $criteria->alias="pro";
        $join="INNER JOIN meta_procedimento mt ON pro.codigo=mt.procedimento_codigo";
        $join=$join." INNER JOIN meta m ON m.id=mt.meta_id INNER JOIN indicador ind ON ind.id=m.indicador_id";
        $criteria->join=$join;
        $criteria->condition="pro.origem=:origem AND ind.status=:status AND ind.profissao_codigo=:codigoProfissao ";
        $criteria->params=array(':origem'=>$origemProcedimento, ':status'=>Indicador::ATIVO, ':codigoProfissao'=>$codigoFuncao);
       return $criteria;
   }
   
   /**
    * @param string $message
    * @param string $tipo
    * @param string $codigo 
    * @return MessageWebService
    */
   private function getMessageWebService($message, $tipo,$codigo=null){
       $m= new MessageWebService();
       $m->setCodigo($codigo);
       $m->setTipo($tipo);
       $m->setMessage($message);
       return $m;
   }
   
   /**
    *verifica se a competência pode ser enviada, se sim, devolve true, senão devolve não
    * @param Competencia $competencia
    * @return boolean 
    */
   private function validarCompetencia($competencia){
       if($competencia->equals($competencia)){
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
       return $this->competencia_boolean;
   }
   
   /**
    *Verifica se o servidor faz parte da equipe, se fizer, devolve true, senão devolve false
    * @param ServidorEquipe $servidor_equipe
    * @return boolean
    */
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
   /**
    *verifica se o medico se já tem o registro do procedimento executado na competencia já foi registrado
    * Se sim, devolve false, senão foi, devolve true
    * @param MedicoExecutaProcedimento $medicoExecutaProcedimento
    * @return type 
    */
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


   private function existeProcedimento($procedimento_codigo){
       return MetaProcedimento::model()->exists(" procedimento_codigo=:codigo",
                                                array(
                                                    ':codigo'=>$procedimento_codigo
                                                    ));
   }


   private function usuarioEstaLogado($usuarioDesktop){
       if($usuarioDesktop!==null){
           return UsuarioDesktopLogado::model()->exists('usuario_desktop_cpf=:cpf AND usuario_token=:token AND usuario_aplicacao=:serial',
                                                array(':cpf'=>$usuarioDesktop->servidor_cpf,':token'=>$usuarioDesktop->token,':serial'=>$usuarioDesktop->serial_aplicacao));
       }
       return false;
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