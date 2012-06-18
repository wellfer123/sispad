<?php
class ProcedimentoController extends SISPADBaseController
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
        private $_competencia_old;
        //vai guardar um true ou false se a competencia anterior é válida
        private $_competencia_boolean;
        
        //vai guardar o valor da competencia anterior
        private $_servidor_equipe_old;
        //vai guardar um true ou false se a competencia anterior é válida
        private $_servidor_equipe_boolean;
        private $_procedimentos=null;
        
        public function actions()
        {
        return array(
            'service'=>array(
                'class'=>'CWebServiceAction',
                'classMap'=>array(
                    'Procedimento'=>'Procedimento',
                    'Unidade'=>'Unidade',
                    'ServidorEquipe'=>'ServidorEquipe',
                    'Odontologo'=>'Odontologo',
                    'Medico'=>'Medico',
                    'Enfermeiro'=>'Enfermeiro',
                    'AgenteSaude'=>'AgenteSaude',
                    'UsuarioDesktop'=>'UsuarioDesktop',
                    'TecnicoEnfermagem'=>'TecnicoEnfermagem',
                    'AuxiliarEnfermagem'=>'AuxiliarEnfermagem',
                    'ServidorExecutaProcedimento'=>'ServidorExecutaProcedimento',
                    'EquipeExecutaProcedimento'=>'EquipeExecutaProcedimento',
                    'MedicoExecutaProcedimento'=>'MedicoExecutaProcedimento',
                    'EnfermeiroExecutaProcedimento'=>'EnfermeiroExecutaProcedimento',
                    'AgenteSaudeExecutaProcedimento'=>'AgenteSaudeExecutaProcedimento',
                    'OdontologoExecutaProcedimento'=>'OdontologoExecutaProcedimento',
                    'TecnicoEnfermagemExecutaProcedimento'=>'TecnicoEnfermagemExecutaProcedimento',
                    'AuxiliarEnfermagemExecutaProcedimento'=>'AuxiliarEnfermagemExecutaProcedimento',
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
        if($this->usuarioEstaLogado($usuarioDesktop)){
            $msg[]=$this->getMessageWebService("O USUÁRIO $usuarioDesktop->usuario_sistema ESTÁ LOGADO COM SUCESSO NO SISPAD", MessageWebService::SUCESSO); 
            return $msg;
        }
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
               //vai apagar todas as seções anteriores do usuário, caso ele não tenha feito o login.
               $this->logout($usuarioDesktop);
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
        $msg=array();
        if($usuarioDesktop!==null){
            if(UsuarioDesktopLogado::model()->deleteAll('usuario_desktop_cpf=:cpf AND  usuario_aplicacao=:serial',
                                                array(':cpf'=>$usuarioDesktop->servidor_cpf,':serial'=>$usuarioDesktop->serial_aplicacao))){
            
                $msg[]=$this->getMessageWebService("SUCESSO: USUÁRIO $usuarioDesktop->usuario_sistema ESTÁ DESCONECTADO DO SISTEMA", MessageWebService::SUCESSO);
             }
            else{
                $msg[]=$this->getMessageWebService("ERRO: USUÁRIO $usuarioDesktop->usuario_sistema NÃO ESTÁ CONECTADO AO SISTEMA", MessageWebService::SUCESSO);
            }
            
        }
        else{
            $msg[]=$this->getMessageWebService("WARNING: USUÁRIO INVÁLIDO", MessageWebService::WARNING);
        }
        return $msg;
    
    }
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Medico[]
     * @soap
     */
    public function getMedicos($codigoUnidade,$usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
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
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimento(Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeMedicoAEnviarSIAB($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(Medico::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeEnfermeiroAEnviarSIAB($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(Enfermeiro::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeOdontologoAEnviarSIAB($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(Odontologo::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeAgenteSaudeAEnviarSIAB($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(AgenteSaude::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeAuxiliarEnfermagemAEnviarSIAB($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(AuxiliarEnfermagem::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeTecnicoEnfermagemAEnviarSIAB($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(TecnicoEnfermagem::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIAB));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosAEnviarSIA($usuarioDesktop){
       if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimento(Procedimento::ORIGEM_SIA));;
    }
    
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeMedicoAEnviarSIA($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(Medico::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIA));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeEnfermeiroAEnviarSIA($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(Enfermeiro::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIA));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeOdontologoAEnviarSIA($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(Odontologo::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIA));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeAgenteSaudeAEnviarSIA($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(AgenteSaude::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIA));
    }
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeAuxiliarEnfermagemAEnviarSIA($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(AuxiliarEnfermagem::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIA));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Procedimento[]
     * @soap
     */
    public function getProcedimentosDeTecnicoEnfermagemAEnviarSIA($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
        return Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional(TecnicoEnfermagem::CODIGO_PROFISSAO, Procedimento::ORIGEM_SIA));
    }
    
    /**
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Unidade[]
     * @soap
     */
    public function getUnidades($usuarioDesktop){
        if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       
       
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
       if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       if($codigoUnidade===null){
           return AgenteSaude::model()->findAll();
       }
        return AgenteSaude::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));;
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return AuxiliarEnfermagem[]
     * @soap
     */
    public function getAuxiliarEnfermagem($codigoUnidade,$usuarioDesktop){
       if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       if($codigoUnidade===null){
           return AuxiliarEnfermagem::model()->findAll();
       }
        return AuxiliarEnfermagem::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));;
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return TecnicoEnfermagem[]
     * @soap
     */
    public function getTecnicoEnfermagem($codigoUnidade,$usuarioDesktop){
       if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       if($codigoUnidade===null){
           return TecnicoEnfermagem::model()->findAll();
       }
        return TecnicoEnfermagem::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));;
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return ServidorEquipe[]
     * @soap
     */
    public function getServidorPorEquipe($codigoUnidade,$usuarioDesktop){
       if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       if($codigoUnidade===null){
           return ServidorEquipe::model()->findAll();
       }
        return ServidorEquipe::model()->findAll('equipe_unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));;
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Odontologo[]
     * @soap
     */
    public function getOdontologos($codigoUnidade,$usuarioDesktop){
       if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
       if($codigoUnidade===null){
           return Odontologo::model()->findAll();
       }
        return Odontologo::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));
    }
    
    /**
     * @param string codigo da unidade
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return Enfermeiro[]
     * @soap
     */
    public function getEnfermeiros($codigoUnidade,$usuarioDesktop){
       if(!$this->usuarioEstaLogado($usuarioDesktop)){
            return array();
        }
        if($codigoUnidade===null){
            return Enfermeiro::model()->findAll();
        }
        return Enfermeiro::model()->findAll('unidade_cnes=:unidade', array(':unidade'=>$codigoUnidade));;
    }


    public function sendExecutadosPorServidor($procedimentosExecutados,$usuarioDesktop){
//        //não implementado ainda
//         $msg=array();
//        try{
//            //arreio de mensagens
//            $this->iniciarVariaveisGlobais();
//            // verifica se o usuário está logado
//            if($this->usuarioEstaLogado($usuarioDesktop)){
//                //verifica se é um vetor de procedimentos executados por medicos
//                if(is_array($procedimentosExecutados)){
//                    foreach($procedimentosExecutados as $proc){
//                        
//                        $servExe= new ServidorExecutaProcedimento();
//                        $compet= new Competencia();
//                        //vai preencher os dados
//                        $servExe->setCompetencia($proc->competencia);
//                        $servExe->setMedico_cpf($proc->servidor_cpf);
//                        $servExe->setMedico_unidade_cnes($proc->unidade_cnes);
//                        $servExe->setProcedimento_codigo($proc->procedimento_codigo);
//                        $servExe->setQuantidade($proc->quantidade);
//                        //carrega as entidades para usar nas mensagens
//                        $ser= $this->loadServidor($proc->servidor_cpf);
//                        $procedi=$this->loadProcedimento($proc->procedimento_codigo);
//                        
//                        $compet->setMesAno($servExe->getCompetencia());
//                        //verifica se a competencia do procedimento executado é válida
//                        if($this->validarCompetencia($compet)){
//                            //é válida, então deve verificar se o servidor pertence mesmo a equipe
//                            $servidor_equipe= new ServidorEquipe;
//                            //preenchendo so valores
//                            $servidor_equipe->setServidorCPF($servExe->getServidor_cpf());
//                            $servidor_equipe->setEquipeUnidadeCNES($servExe->getUnidade_cnes());
//                            $servidor_equipe->setFuncao(null);
//                            if($this->IsServidorEquipe($servidor_equipe)){
//                                if($this->existProcedimentoEmMetaProfissional($servExe->getProcedimento_codigo(),  Medico::CODIGO_PROFISSAO)){
//                                    //agora verifica se o registro já existe, senão existir, vai cadastrar
//                                    if($this->validarProcedimentoExecutadomedico($servExe)){
//                                        //vai salvar o registro
//                                        try{
//                                            //vai salvar o objeto
//                                            if($servExe->save()){
//                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nTÉCNICO EM ENFERMAGEM: $ser->nome \nSUCESSO: PROCEDIMENTO EXECUTADO PELO TÉCNICO EM ENFERMAGEM REGISTRADO COM SUCESSO", MessageWebService::SUCESSO); 
//                                            }
//                                            //erro ao salvar
//                                            else{
//                                                //adiciona o erro ao vetor
//                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nTÉCNICO EM ENFERMAGEM: $ser->nome \nERRO: NÃO FOI POSSÍVEL REGISTRAR O PROCEDIMENTO EXECUTADO PELO TÉCNICO EM ENFERMAGEM", MessageWebService::ERRO);
//                                            }
//                                        }catch(Exception $ex){
//                                            $tmp=$ex->getMessage();
//                                            //adiciona o erro ao vetor
//                                            $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nTÉCNICO EM ENFERMAGEM: $ser->nome \nERRO INESPERADO AO TENTAR SALVAR O PROCEDIMENTO EXECUTADO PELO TÉCNICO EM ENFERMAGEM! $tmp", MessageWebService::ERRO); 
//                                        } 
//                                        //terminou o try
//                                    }
//                                    //já foi enviado
//                                    else{
//                                        $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nTÉCNICO EM ENFERMAGEM: $ser->nome \nERRO: JÁ FOI ENVIADO PARA A COMPETÊNCIA $servExe->competencia", MessageWebService::ERRO); 
//                                    }
//                                }
//                                //o rpocedimento não faz parte de nenhuma meta
//                                else{
//                                   $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome\n WARNING: NÃO FAZ PARTE DE NENHUMA META PARA TÉCNICO EM ENFERMAGEM. ENTÃO FOI DESCARTADO!", MessageWebService::WARNING); 
//                                }
//                            }
//                            //TÉCNICO EM ENFERMAGEM não faz parte da equipe
//                            else{
//                               $msg[]=$this->getMessageWebService("TÉCNICO EM ENFERMAGEM: $ser->nome \nERRO: NÃO ESTÁ CADASTRADO EM NENHUMA EQUIPE", MessageWebService::ERRO); 
//                            }
//                        }
//                        //competência inválida
//                        else{
//                            $msg[]=$this->getMessageWebService("ERRO: COMPETÊNCIA INVÁLIDA, $servExe->competencia", MessageWebService::ERRO);
//                        }
//                        
//                    }
//                }
//                //não foi um array de procedimentos executados por medicos
//                else{
//                    //adiciona o erro ao vetor
//                    $msg[]=$this->getMessageWebService("ERRO: DEVE-SE ENVIAR UMA LISTA DE PROCEDIMENTOS EXECUTADOS POR UM TÉCNICO EM ENFERMAGEM!", MessageWebService::ERRO);
//                    
//                }
//            }
//            //não está logado
//            else{
//                $msg[]=$this->getMessageWebService("ERRO: DEVE-SE FAZER LOGIN NO WEB SERVICE!", MessageWebService::ERRO);
//            }
//        }catch(Exception $ex){
//            $tmp=$ex->getMessage();
//            $msg[]=$this->getMessageWebService("ERRO INESPERADO A CHAMADA DO MÉTODO! $tmp",MessageWebService::ERRO);
//        }
//        return $msg;
    }
    
    /**
     * @param MedicoExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorMedico($procedimentosExecutados,$usuarioDesktop){
        $msg=array();
        try{
            //arreio de mensagens
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
                                if($this->existProcedimentoEmMetaProfissional($medExe->getProcedimento_codigo(),  Medico::CODIGO_PROFISSAO)){
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
                                   $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome\n WARNING: NÃO FAZ PARTE DE NENHUMA META PARA MÉDICO. ENTÃO FOI DESCARTADO!", MessageWebService::WARNING); 
                                }
                            }
                            //MÉDICO não faz parte da equipe
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
     * @param TecnicoEnfermagemExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorTecnicoEnfermagem($procedimentosExecutados,$usuarioDesktop){
        $msg=array();
        try{
            //arreio de mensagens
            $this->iniciarVariaveisGlobais();
            // verifica se o usuário está logado
            if($this->usuarioEstaLogado($usuarioDesktop)){
                //verifica se é um vetor de procedimentos executados por medicos
                if(is_array($procedimentosExecutados)){
                    foreach($procedimentosExecutados as $proc){
                        
                        $tecnicoEnferExe= new TecnicoEnfermagemExecutaProcedimento();
                        $compet= new Competencia();
                        //vai preencher os dados
                        $tecnicoEnferExe->setCompetencia($proc->competencia);
                        $tecnicoEnferExe->setTecnico_enfermagem_cpf($proc->tecnico_enfermagem_cpf);
                        $tecnicoEnferExe->setTecnico_enfermagem_unidade_cnes($proc->tecnico_enfermagem_unidade_cnes);
                        $tecnicoEnferExe->setProcedimento_codigo($proc->procedimento_codigo);
                        $tecnicoEnferExe->setQuantidade($proc->quantidade);
                        //carrega as entidades para usar nas mensagens
                        $ser= $this->loadServidor($proc->tecnico_enfermagem_cpf);
                        $procedi=$this->loadProcedimento($proc->procedimento_codigo);
                        
                        $compet->setMesAno($tecnicoEnferExe->getCompetencia());
                        //verifica se a competencia do procedimento executado é válida
                        if($this->validarCompetencia($compet)){
                            //é válida, então deve verificar se o servidor pertence mesmo a equipe
                            $servidor_equipe= new ServidorEquipe;
                            //preenchendo so valores
                            $servidor_equipe->setServidorCPF($tecnicoEnferExe->getTecnico_enfermagem_cpf());
                            $servidor_equipe->setEquipeUnidadeCNES($tecnicoEnferExe->getTecnico_enfermagem_unidade_cnes());
                            $servidor_equipe->setFuncao("TecnicoEnfermagem");
                            if($this->IsServidorEquipe($servidor_equipe)){
                                if($this->existProcedimentoEmMetaProfissional($tecnicoEnferExe->getProcedimento_codigo(),  TecnicoEnfermagem::CODIGO_PROFISSAO)){
                                    //agora verifica se o registro já existe, senão existir, vai cadastrar
                                    if($this->validarProcedimentoExecutadoTecnicoEnfermagem($tecnicoEnferExe)){
                                        //vai salvar o registro
                                        try{
                                            //vai salvar o objeto
                                            if($tecnicoEnferExe->save()){
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nTÉCNICO EM ENFERMAGEM: $ser->nome \nSUCESSO: PROCEDIMENTO EXECUTADO PELO TÉCNICO EM ENFERMAGEM REGISTRADO COM SUCESSO", MessageWebService::SUCESSO); 
                                            }
                                            //erro ao salvar
                                            else{
                                                //adiciona o erro ao vetor
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nTÉCNICO EM ENFERMAGEM: $ser->nome \nERRO: NÃO FOI POSSÍVEL REGISTRAR O PROCEDIMENTO EXECUTADO PELO TÉCNICO EM ENFERMAGEM", MessageWebService::ERRO);
                                            }
                                        }catch(Exception $ex){
                                            $tmp=$ex->getMessage();
                                            //adiciona o erro ao vetor
                                            $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nTÉCNICO EM ENFERMAGEM: $ser->nome \nERRO INESPERADO AO TENTAR SALVAR O PROCEDIMENTO EXECUTADO PELO TÉCNICO EM ENFERMAGEM! $tmp", MessageWebService::ERRO); 
                                        } 
                                        //terminou o try
                                    }
                                    //já foi enviado
                                    else{
                                        $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nTÉCNICO EM ENFERMAGEM: $ser->nome \nERRO: JÁ FOI ENVIADO PARA A COMPETÊNCIA $tecnicoEnferExe->competencia", MessageWebService::ERRO); 
                                    }
                                }
                                //o rpocedimento não faz parte de nenhuma meta
                                else{
                                   $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome\n WARNING: NÃO FAZ PARTE DE NENHUMA META PARA TÉCNICO EM ENFERMAGEM. ENTÃO FOI DESCARTADO!", MessageWebService::WARNING); 
                                }
                            }
                            //TÉCNICO EM ENFERMAGEM não faz parte da equipe
                            else{
                               $msg[]=$this->getMessageWebService("TÉCNICO EM ENFERMAGEM: $ser->nome \nERRO: NÃO ESTÁ CADASTRADO EM NENHUMA EQUIPE", MessageWebService::ERRO); 
                            }
                        }
                        //competência inválida
                        else{
                            $msg[]=$this->getMessageWebService("ERRO: COMPETÊNCIA INVÁLIDA, $tecnicoEnferExe->competencia", MessageWebService::ERRO);
                        }
                        
                    }
                }
                //não foi um array de procedimentos executados por medicos
                else{
                    //adiciona o erro ao vetor
                    $msg[]=$this->getMessageWebService("ERRO: DEVE-SE ENVIAR UMA LISTA DE PROCEDIMENTOS EXECUTADOS POR UM TÉCNICO EM ENFERMAGEM!", MessageWebService::ERRO);
                    
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
     * @param AuxiliarEnfermagemExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorAuxiliarEnfermagem($procedimentosExecutados,$usuarioDesktop){
        $msg=array();
        try{
            //arreio de mensagens
            $this->iniciarVariaveisGlobais();
            // verifica se o usuário está logado
            if($this->usuarioEstaLogado($usuarioDesktop)){
                //verifica se é um vetor de procedimentos executados por medicos
                if(is_array($procedimentosExecutados)){
                    foreach($procedimentosExecutados as $proc){
                        
                        $auxiliarEnferExe= new TecnicoEnfermagemExecutaProcedimento();
                        $compet= new Competencia();
                        //vai preencher os dados
                        $auxiliarEnferExe->setCompetencia($proc->competencia);
                        $auxiliarEnferExe->setAuxiliar_enfermagem_cpf($proc->auxiliar_enfermagem_cpf);
                        $auxiliarEnferExe->setAuxiliar_enfermagem_unidade_cnes($proc->auxiliar_enfermagem_unidade_cnes);
                        $auxiliarEnferExe->setProcedimento_codigo($proc->procedimento_codigo);
                        $auxiliarEnferExe->setQuantidade($proc->quantidade);
                        //carrega as entidades para usar nas mensagens
                        $ser= $this->loadServidor($proc->auxiliar_enfermagem_cpf);
                        $procedi=$this->loadProcedimento($proc->procedimento_codigo);
                        
                        $compet->setMesAno($auxiliarEnferExe->getCompetencia());
                        //verifica se a competencia do procedimento executado é válida
                        if($this->validarCompetencia($compet)){
                            //é válida, então deve verificar se o servidor pertence mesmo a equipe
                            $servidor_equipe= new ServidorEquipe;
                            //preenchendo so valores
                            $servidor_equipe->setServidorCPF($auxiliarEnferExe->getAuxiliar_enfermagem_cpf());
                            $servidor_equipe->setEquipeUnidadeCNES($auxiliarEnferExe->getAuxiliar_enfermagem_unidade_cnes());
                            $servidor_equipe->setFuncao("AuxiliarEnfermagem");
                            if($this->IsServidorEquipe($servidor_equipe)){
                                if($this->existProcedimentoEmMetaProfissional($auxiliarEnferExe->getProcedimento_codigo(), AuxiliarEnfermagem::CODIGO_PROFISSAO)){
                                    //agora verifica se o registro já existe, senão existir, vai cadastrar
                                    if($this->validarProcedimentoExecutadoAuxiliarEnfermagem($auxiliarEnferExe)){
                                        //vai salvar o registro
                                        try{
                                            //vai salvar o objeto
                                            if($auxiliarEnferExe->save()){
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nAUXILIAR DE ENFERMAGEM: $ser->nome \nSUCESSO: PROCEDIMENTO EXECUTADO PELO AUXILIAR DE ENFERMAGEM REGISTRADO COM SUCESSO", MessageWebService::SUCESSO); 
                                            }
                                            //erro ao salvar
                                            else{
                                                //adiciona o erro ao vetor
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nAUXILIAR DE ENFERMAGEM: $ser->nome \nERRO: NÃO FOI POSSÍVEL REGISTRAR O PROCEDIMENTO EXECUTADO PELO AUXILIAR DE ENFERMAGEM", MessageWebService::ERRO);
                                            }
                                        }catch(Exception $ex){
                                            $tmp=$ex->getMessage();
                                            //adiciona o erro ao vetor
                                            $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nAUXILIAR DE ENFERMAGEM: $ser->nome \nERRO INESPERADO AO TENTAR SALVAR O PROCEDIMENTO EXECUTADO PELO AUXILIAR DE ENFERMAGEM! $tmp", MessageWebService::ERRO); 
                                        } 
                                        //terminou o try
                                    }
                                    //já foi enviado
                                    else{
                                        $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nAUXILIAR DE ENFERMAGEM: $ser->nome \nERRO: JÁ FOI ENVIADO PARA A COMPETÊNCIA $auxiliarEnferExe->competencia", MessageWebService::ERRO); 
                                    }
                                }
                                //o rpocedimento não faz parte de nenhuma meta
                                else{
                                   $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome\n WARNING: NÃO FAZ PARTE DE NENHUMA META PARA AUXILIAR DE ENFERMAGEM. ENTÃO FOI DESCARTADO!", MessageWebService::WARNING); 
                                }
                            }
                            //AUXILIAR DE ENFERMAGEM não faz parte da equipe
                            else{
                               $msg[]=$this->getMessageWebService("AUXILIAR DE ENFERMAGEM: $ser->nome \nERRO: NÃO ESTÁ CADASTRADO EM NENHUMA EQUIPE", MessageWebService::ERRO); 
                            }
                        }
                        //competência inválida
                        else{
                            $msg[]=$this->getMessageWebService("ERRO: COMPETÊNCIA INVÁLIDA, $auxiliarEnferExe->competencia", MessageWebService::ERRO);
                        }
                        
                    }
                }
                //não foi um array de procedimentos executados por medicos
                else{
                    //adiciona o erro ao vetor
                    $msg[]=$this->getMessageWebService("ERRO: DEVE-SE ENVIAR UMA LISTA DE PROCEDIMENTOS EXECUTADOS POR UM AUXILIAR DE ENFERMAGEM!", MessageWebService::ERRO);
                    
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
       $msg2=array();
       try{
            $this->iniciarVariaveisGlobais();
            // verifica se o usuário está logado
            if($this->usuarioEstaLogado($usuarioDesktop)){
                //verifica se é um vetor de procedimentos executados por medicos
                if(is_array($procedimentosExecutados)){
                    foreach($procedimentosExecutados as $proc){
                        
                        $enfExe= new EnfermeiroExecutaProcedimento();
                        $compet= new Competencia();
                        //vai preencher os dados
                        $enfExe->setCompetencia($proc->competencia);
                        $enfExe->setEnfermeiro_cpf($proc->enfermeiro_cpf);
                        $enfExe->setEnfermeiro_unidade_cnes($proc->enfermeiro_unidade_cnes);
                        $enfExe->setProcedimento_codigo($proc->procedimento_codigo);
                        $enfExe->setQuantidade($proc->quantidade);
                        //carrega as entidades para usar nas mensagens
                        $ser= $this->loadServidor($proc->enfermeiro_cpf);
                        $procedi=$this->loadProcedimento($proc->procedimento_codigo);
                        
                        $compet->setMesAno($enfExe->getCompetencia());
                        //verifica se a competencia do procedimento executado é válida
                        if($this->validarCompetencia($compet)){
                            //é válida, então deve verificar se o servidor pertence mesmo a equipe
                            $servidor_equipe= new ServidorEquipe;
                            //preenchendo so valores
                            $servidor_equipe->setServidorCPF($enfExe->getEnfermeiro_cpf());
                            $servidor_equipe->setEquipeUnidadeCNES($enfExe->getEnfermeiro_unidade_cnes());
                            $servidor_equipe->setFuncao("Enfermeiro");
                            if($this->IsServidorEquipe($servidor_equipe)){
                                if($this->existProcedimentoEmMetaProfissional($enfExe->getProcedimento_codigo(), Enfermeiro::CODIGO_PROFISSAO)){
                                    //agora verifica se o registro já existe, senão existir, vai cadastrar
                                    if($this->validarProcedimentoExecutadoEnfermeiro($enfExe)){
                                        //vai salvar o registro
                                        try{
                                            //vai salvar o objeto
                                            if($enfExe->save()){
                                                $msg2[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nENFERMEIRO: $ser->nome \nSUCESSO: PROCEDIMENTO EXECUTADO PELO ENFERMEIRO REGISTRADO COM SUCESSO", MessageWebService::SUCESSO); 
                                            }
                                            //erro ao salvar
                                            else{
                                                //adiciona o erro ao vetor
                                                $msg2[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nENFERMEIRO: $ser->nome \nERRO: NÃO FOI POSSÍVEL REGISTRAR O PROCEDIMENTO EXECUTADO PELO ENFERMEIRO", MessageWebService::ERRO);
                                            }
                                        }catch(Exception $ex){
                                            $tmp=$ex->getMessage();
                                            //adiciona o erro ao vetor
                                            $msg2[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nENFERMEIRO: $ser->nome \nERRO INESPERADO AO TENTAR SALVAR O PROCEDIMENTO EXECUTADO PELO ENFERMEIRO! $tmp", MessageWebService::ERRO); 
                                        } 
                                        //terminou o try
                                    }
                                    //já foi enviado
                                    else{
                                        $msg2[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nENFERMEIRO: $ser->nome \nERRO: JÁ FOI ENVIADO PARA A COMPETÊNCIA $enfExe->competencia", MessageWebService::ERRO); 
                                    }
                                }
                                //o rpocedimento não faz parte de nenhuma meta
                                else{
                                   $msg2[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome\n WARNING: NÃO FAZ PARTE DE NENHUMA META PARA ENFERMEIRO. ENTÃO FOI DESCARTADO!", MessageWebService::WARNING); 
                                }
                            }
                            //TÉCNICO EM ENFERMAGEM não faz parte da equipe
                            else{
                               $msg2[]=$this->getMessageWebService("ENFERMEIRO: $ser->nome \nERRO: NÃO ESTÁ CADASTRADO EM NENHUMA EQUIPE", MessageWebService::ERRO); 
                            }
                        }
                        //competência inválida
                        else{
                            $msg2[]=$this->getMessageWebService("ERRO: COMPETÊNCIA INVÁLIDA, $enfExe->competencia", MessageWebService::ERRO);
                        }
                        
                    }
                }
                //não foi um array de procedimentos executados por medicos
                else{
                    //adiciona o erro ao vetor
                    $msg2[]=$this->getMessageWebService("ERRO: DEVE-SE ENVIAR UMA LISTA DE PROCEDIMENTOS EXECUTADOS POR UM ENFERMEIRO!", MessageWebService::ERRO);
                    
                }
            }
            //não está logado
            else{
                $msg2[]=$this->getMessageWebService("ERRO: DEVE-SE FAZER LOGIN NO WEB SERVICE!", MessageWebService::ERRO);
            }
        }catch(Exception $ex){
            $tmp=$ex->getMessage();
            $msg2[]=$this->getMessageWebService("ERRO INESPERADO A CHAMADA DO MÉTODO! $tmp",MessageWebService::ERRO);
        }
        return $msg2;
    }
    
    /**
     * @param OdontologoExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorOdontologo($procedimentosExecutados,$usuarioDesktop){
        $msg=array();
         try{
            //arreio de mensagens
            $this->iniciarVariaveisGlobais();
            // verifica se o usuário está logado
            if($this->usuarioEstaLogado($usuarioDesktop)){
                //verifica se é um vetor de procedimentos executados por medicos
                if(is_array($procedimentosExecutados)){
                    foreach($procedimentosExecutados as $proc){
                        
                        $odonExe= new OdontologoExecutaProcedimento();
                        $compet= new Competencia();
                        //vai preencher os dados
                        $odonExe->setCompetencia($proc->competencia);
                        $odonExe->setOdontologo_cpf($proc->odontologo_cpf);
                        $odonExe->setOdontologo_unidade_cnes($proc->odontologo_unidade_cnes);
                        $odonExe->setProcedimento_codigo($proc->procedimento_codigo);
                        $odonExe->setQuantidade($proc->quantidade);
                        //carrega as entidades para usar nas mensagens
                        $ser= $this->loadServidor($proc->odontologo_cpf);
                        $procedi=$this->loadProcedimento($proc->procedimento_codigo);
                        
                        $compet->setMesAno($odonExe->getCompetencia());
                        //verifica se a competencia do procedimento executado é válida
                        if($this->validarCompetencia($compet)){
                            //é válida, então deve verificar se o servidor pertence mesmo a equipe
                            $servidor_equipe= new ServidorEquipe;
                            //preenchendo so valores
                            $servidor_equipe->setServidorCPF($odonExe->getOdontologo_cpf());
                            $servidor_equipe->setEquipeUnidadeCNES($odonExe->getOdontologo_unidade_cnes());
                            $servidor_equipe->setFuncao("Odontologo");
                            if($this->IsServidorEquipe($servidor_equipe)){
                                if($this->existProcedimentoEmMetaProfissional($odonExe->getProcedimento_codigo(), Odontologo::CODIGO_PROFISSAO)){
                                    //agora verifica se o registro já existe, senão existir, vai cadastrar
                                    if($this->validarProcedimentoExecutadoOdontologo($odonExe)){
                                        //vai salvar o registro
                                        try{
                                            //vai salvar o objeto
                                            if($odonExe->save()){
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nODONTÓLOGO: $ser->nome \nSUCESSO: PROCEDIMENTO EXECUTADO PELO ODONTÓLOGO REGISTRADO COM SUCESSO", MessageWebService::SUCESSO); 
                                            }
                                            //erro ao salvar
                                            else{
                                                //adiciona o erro ao vetor
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nODONTÓLOGO: $ser->nome \nERRO: NÃO FOI POSSÍVEL REGISTRAR O PROCEDIMENTO EXECUTADO PELO ODONTÓLOGO", MessageWebService::ERRO);
                                            }
                                        }catch(Exception $ex){
                                            $tmp=$ex->getMessage();
                                            //adiciona o erro ao vetor
                                            $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nODONTÓLOGO: $ser->nome \nERRO INESPERADO AO TENTAR SALVAR O PROCEDIMENTO EXECUTADO PELO ODONTÓLOGO! $tmp", MessageWebService::ERRO); 
                                        } 
                                        //terminou o try
                                    }
                                    //já foi enviado
                                    else{
                                        $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nODONTÓLOGO: $ser->nome \nERRO: JÁ FOI ENVIADO PARA A COMPETÊNCIA $odonExe->competencia", MessageWebService::ERRO); 
                                    }
                                }
                                //o rpocedimento não faz parte de nenhuma meta
                                else{
                                   $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome\n WARNING: NÃO FAZ PARTE DE NENHUMA META PARA ODONTÓLOGO. ENTÃO FOI DESCARTADO!", MessageWebService::WARNING); 
                                }
                            }
                            //TÉCNICO EM ENFERMAGEM não faz parte da equipe
                            else{
                               $msg[]=$this->getMessageWebService("ODONTÓLOGO: $ser->nome \nERRO: NÃO ESTÁ CADASTRADO EM NENHUMA EQUIPE", MessageWebService::ERRO); 
                            }
                        }
                        //competência inválida
                        else{
                            $msg[]=$this->getMessageWebService("ERRO: COMPETÊNCIA INVÁLIDA, $odonExe->competencia", MessageWebService::ERRO);
                        }
                        
                    }
                }
                //não foi um array de procedimentos executados por medicos
                else{
                    //adiciona o erro ao vetor
                    $msg[]=$this->getMessageWebService("ERRO: DEVE-SE ENVIAR UMA LISTA DE PROCEDIMENTOS EXECUTADOS POR UM ODONTÓLOGO!", MessageWebService::ERRO);
                    
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
     * @param AgenteSaudeExecutaProcedimento[]
     * @param UsuarioDesktop usuario da aplicao desktop
     * @return MessageWebService[]
     * @soap
     */
    public function sendExecutadosPorAgenteSaude($procedimentosExecutados,$usuarioDesktop){
        $msg=array();
         try{
            $this->iniciarVariaveisGlobais();
            // verifica se o usuário está logado
            if($this->usuarioEstaLogado($usuarioDesktop)){
                //verifica se é um vetor de procedimentos executados por medicos
                if(is_array($procedimentosExecutados)){
                    foreach($procedimentosExecutados as $proc){
                        
                        $agentExe= new AgenteSaudeExecutaProcedimento();
                        $compet= new Competencia();
                        //vai preencher os dados
                        $agentExe->setCompetencia($proc->competencia); 
                        $agentExe->setAgente_saude_micro_area($proc->agente_saude_micro_area);
                        $agentExe->setAgente_saude_cpf($proc->agente_saude_cpf);
                        $agentExe->setAgente_saude_unidade_cnes($proc->agente_saude_unidade_cnes);
                        $agentExe->setProcedimento_codigo($proc->procedimento_codigo);
                        $agentExe->setQuantidade($proc->quantidade);
                        //carrega as entidades para usar nas mensagens
                        $ser= $this->loadServidor($proc->agente_saude_cpf);
                        $procedi=$this->loadProcedimento($proc->procedimento_codigo);
                        
                        $compet->setMesAno($agentExe->getCompetencia());
                        //verifica se a competencia do procedimento executado é válida
                        if($this->validarCompetencia($compet)){
                            //é válida, então deve verificar se o servidor pertence mesmo a equipe
                            $servidor_equipe= new ServidorEquipe;
                            //preenchendo so valores
                            $servidor_equipe->setServidorCPF($agentExe->getAgente_saude_cpf());
                            $servidor_equipe->setEquipeUnidadeCNES($agentExe->getAgente_saude_unidade_cnes());
                            $servidor_equipe->setFuncao("AgenteSaude");
                            if($this->IsServidorEquipe($servidor_equipe)){
                                if($this->existProcedimentoEmMetaProfissional($agentExe->getProcedimento_codigo(), AgenteSaude::CODIGO_PROFISSAO)){
                                    //agora verifica se o registro já existe, senão existir, vai cadastrar
                                    if($this->validarProcedimentoExecutadoAgenteSaude($agentExe)){
                                        //vai salvar o registro
                                        try{
                                            //vai salvar o objeto
                                            if($agentExe->save()){
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nAGENTE DE SAÚDE: $ser->nome \nSUCESSO: PROCEDIMENTO EXECUTADO PELO AGENTE DE SAÚDE REGISTRADO COM SUCESSO", MessageWebService::SUCESSO); 
                                            }
                                            //erro ao salvar
                                            else{
                                                //adiciona o erro ao vetor
                                                $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nAGENTE DE SAÚDE: $ser->nome \nERRO: NÃO FOI POSSÍVEL REGISTRAR O PROCEDIMENTO EXECUTADO PELO AGENTE DE SAÚDE", MessageWebService::ERRO);
                                            }
                                        }catch(Exception $ex){
                                            $tmp=$ex->getMessage();
                                            //adiciona o erro ao vetor
                                            $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nAGENTE DE SAÚDE: $ser->nome \nERRO INESPERADO AO TENTAR SALVAR O PROCEDIMENTO EXECUTADO PELO AGENTE DE SAÚDE! $tmp", MessageWebService::ERRO); 
                                        } 
                                        //terminou o try
                                    }
                                    //já foi enviado
                                    else{
                                        $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome \nAGENTE DE SAÚDE: $ser->nome \nERRO: JÁ FOI ENVIADO PARA A COMPETÊNCIA $agentExe->competencia", MessageWebService::ERRO); 
                                    }
                                }
                                //o rpocedimento não faz parte de nenhuma meta
                                else{
                                   $msg[]=$this->getMessageWebService("PROCEDIMENTO: $procedi->nome\n WARNING: NÃO FAZ PARTE DE NENHUMA META PARA AGENTE DE SAÚDE. ENTÃO FOI DESCARTADO!", MessageWebService::WARNING); 
                                }
                            }
                            //TÉCNICO EM ENFERMAGEM não faz parte da equipe
                            else{
                               $msg[]=$this->getMessageWebService("AGENTE DE SAÚDE: $ser->nome \nERRO: NÃO ESTÁ CADASTRADO EM NENHUMA EQUIPE", MessageWebService::ERRO); 
                            }
                        }
                        //competência inválida
                        else{
                            $msg[]=$this->getMessageWebService("ERRO: COMPETÊNCIA INVÁLIDA, $agentExe->competencia ", MessageWebService::ERRO);
                        }
                        
                    }
                }
                //não foi um array de procedimentos executados por medicos
                else{
                    //adiciona o erro ao vetor
                    $msg[]=$this->getMessageWebService("ERRO: DEVE-SE ENVIAR UMA LISTA DE PROCEDIMENTOS EXECUTADOS POR UM AGENTE DE SAÚDE!", MessageWebService::ERRO);
                    
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
  
   //métodos privados
    
   private function iniciarVariaveisGlobais(){
       $this->_competencia_boolean=false;
       $this->_competencia_old=-9999999;
       $this->_servidor_equipe_boolean=false;
       $this->_servidor_equipe_old=null;
       $this->_procedimentos=null;
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
   private function getCDBcriteriaProcedimentoPorProfissional($codigoFuncao, $origemProcedimento=null){
        $criteria= new CDbCriteria();
        $criteria->select=" pro.codigo, pro.nome";
        $criteria->distinct=true;
        $criteria->alias="pro";
        $join="INNER JOIN meta_procedimento mt ON pro.codigo=mt.procedimento_codigo";
        $join=$join." INNER JOIN meta m ON m.id=mt.meta_id INNER JOIN indicador ind ON ind.id=m.indicador_id";
        $criteria->join=$join;
        if($origemProcedimento!==null){
            $criteria->condition="pro.origem=:origem AND ind.status=:status AND ind.profissao_codigo=:codigoProfissao ";
            $criteria->params=array(':origem'=>$origemProcedimento, ':status'=>Indicador::ATIVO, ':codigoProfissao'=>$codigoFuncao);
        }
        else{
            $criteria->condition=" ind.status=:status AND ind.profissao_codigo=:codigoProfissao ";
            $criteria->params=array(':status'=>Indicador::ATIVO, ':codigoProfissao'=>$codigoFuncao);
        }
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
       if($competencia->equals($this->_competencia_old)){
           if($this->_competencia_boolean){
               return true;
           }
       }
       $this->_competencia_old=$competencia;
       $this->_competencia_boolean=Competencia::model()->exists("mes_ano=:valor AND ativo=:ativo",
                                                                array(
                                                                    ':valor'=>$competencia->mes_ano,
                                                                    ':ativo'=>  Competencia::ABERTA
                                                                ));
       return $this->_competencia_boolean;
   }
   
   /**
    *Verifica se o servidor faz parte da equipe, se fizer, devolve true, senão devolve false
    * @param ServidorEquipe $servidor_equipe
    * @return boolean
    */
   private function IsServidorEquipe($servidor_equipe){
       if($servidor_equipe->equals($this->_servidor_equipe_old)){
           if($this->_servidor_equipe_boolean){
               return true;
           }
       }
       //o servidorEquipe e diferente ou não foi válido o anterior
       $this->_servidor_equipe_old=$servidor_equipe;
       $this->_servidor_equipe_boolean=ServidorEquipe::model()->exists(" servidor_cpf=:servidor AND equipe_unidade_cnes=:cnes AND funcao=:funcao AND ativo=:ativo",
                                                array(
                                                        ':servidor'=>$servidor_equipe->servidor_cpf,
                                                        ':cnes'=>$servidor_equipe->equipe_unidade_cnes,
                                                        ':funcao'=>$servidor_equipe->funcao,
                                                        ':ativo'=>ServidorEquipe::ATIVO
                                                ));
       return $this->_servidor_equipe_boolean;
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
   
   private function validarProcedimentoExecutadoOdontologo($odontologoExecutaProcedimento){
       //se existir vai retornar falso
       return !$odontologoExecutaProcedimento->exists("odontologo_cpf=:odontologo AND procedimento_codigo=:procedimento
                               AND odontologo_unidade_cnes=:unidade AND competencia=:competencia",
                               array(':odontologo'=>$odontologoExecutaProcedimento->getOdontologo_cpf(),
                                    ':procedimento'=>$odontologoExecutaProcedimento->getProcedimento_codigo(),
                                    ':unidade'=>$odontologoExecutaProcedimento->getOdontologo_unidade_cnes(),
                                    ':competencia'=>$odontologoExecutaProcedimento->getCompetencia()
                                    )
                               );
   }
   
   private function validarProcedimentoExecutadoAgenteSaude($agenteSaudeExecutaProcedimento){
       //se existir vai retornar falso
       return !$agenteSaudeExecutaProcedimento->exists("agente_saude_cpf=:agenteSaude AND procedimento_codigo=:procedimento
                               AND agente_saude_micro_area=:microArea AND agente_saude_unidade_cnes=:unidade AND competencia=:competencia",
                               array(':agenteSaude'=>$agenteSaudeExecutaProcedimento->getAgente_saude_cpf(),
                                    ':procedimento'=>$agenteSaudeExecutaProcedimento->getProcedimento_codigo(),
                                    ':unidade'=>$agenteSaudeExecutaProcedimento->getAgente_saude_unidade_cnes(),
                                    ':microArea'=>$agenteSaudeExecutaProcedimento->getAgente_saude_micro_area(),
                                    ':competencia'=>$agenteSaudeExecutaProcedimento->getCompetencia()
                                    )
                               );
   }
   
   private function validarProcedimentoExecutadoEnfermeiro($enfermeiroExecutaProcedimento){
       //se existir vai retornar falso
       return !$enfermeiroExecutaProcedimento->exists("enfermeiro_cpf=:enfermeiro AND procedimento_codigo=:procedimento
                               AND enfermeiro_unidade_cnes=:unidade AND competencia=:competencia",
                               array(':enfermeiro'=>$enfermeiroExecutaProcedimento->getEnfermeiro_cpf(),
                                    ':procedimento'=>$enfermeiroExecutaProcedimento->getProcedimento_codigo(),
                                    ':unidade'=>$enfermeiroExecutaProcedimento->getEnfermeiro_unidade_cnes(),
                                    ':competencia'=>$enfermeiroExecutaProcedimento->getCompetencia()
                                    )
                               );
   }
   
   private function validarProcedimentoExecutadoTecnicoEnfermagem($TecnicoEnfermagemExecutaProcedimento){
       //se existir vai retornar falso
       return !$TecnicoEnfermagemExecutaProcedimento->exists("tecnico_enfermagem_cpf=:tecnico_enfermagem AND procedimento_codigo=:procedimento
                               AND tecnico_enfermagem_unidade_cnes=:unidade AND competencia=:competencia",
                               array(':tecnico_enfermagem'=>$TecnicoEnfermagemExecutaProcedimento->getTecnico_enfermagem_cpf(),
                                    ':procedimento'=>$TecnicoEnfermagemExecutaProcedimento->getProcedimento_codigo(),
                                    ':unidade'=>$TecnicoEnfermagemExecutaProcedimento->getTecnico_enfermagem_unidade_cnes(),
                                    ':competencia'=>$TecnicoEnfermagemExecutaProcedimento->getCompetencia()
                                    )
                               );
   }
   
   private function validarProcedimentoExecutadoAuxiliarEnfermagem($AuxiliarEnfermagemExecutaProcedimento){
       //se existir vai retornar falso
       return !$AuxiliarEnfermagemExecutaProcedimento->exists("auxiliar_enfermagem_cpf=:auxiliar_enfermagem AND procedimento_codigo=:procedimento
                               AND auxiliar_enfermagem_unidade_cnes=:unidade AND competencia=:competencia",
                               array(':auxiliar_enfermagem'=>$AuxiliarEnfermagemExecutaProcedimento->getEnfermeiro_cpf(),
                                    ':procedimento'=>$AuxiliarEnfermagemExecutaProcedimento->getProcedimento_codigo(),
                                    ':unidade'=>$AuxiliarEnfermagemExecutaProcedimento->getEnfermeiro_unidade_cnes(),
                                    ':competencia'=>$AuxiliarEnfermagemExecutaProcedimento->getCompetencia()
                                    )
                               );
   }

   private function existProcedimentoEmMetaProfissional($procedimento_codigo, $codigoProfisao){
       if($this->_procedimentos===null){
          $this->_procedimentos=Procedimento::model()->findAll($this->getCDBcriteriaProcedimentoPorProfissional($codigoProfisao));
       }
       foreach($this->_procedimentos as $proc){
           if($proc->codigo===$procedimento_codigo){
               return true;
           }
       }
       return false;
   }


   private function usuarioEstaLogado($usuarioDesktop){
       if($usuarioDesktop!==null){
           $user=UsuarioDesktopLogado::model()->find('usuario_desktop_cpf=:cpf AND  usuario_aplicacao=:serial',
                                                array(':cpf'=>$usuarioDesktop->servidor_cpf,':serial'=>$usuarioDesktop->serial_aplicacao));
           
           //calcula a diferença entre as data
           //depois divide por 3600 (segundos de uma hora), se for maior que um, então a sessão está inválida
           if($user!==null){
               return true;
//                $time= new DateTime( $user->data_hora);
//                return (time() - $time->getTimestamp())/3600>1 ? false:true;
           }
       }
       return false;
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

    protected function getModelName() {
        return "Procedimento";
    }
}