<?php

class ServicoController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        
        public function actions(){
                    
            return array(
            'main'=>array(
                'class'=>'CWebServiceAction',
                'classMap'=>array(
                    'ProcedimentoRealizado'=>'ProcedimentoRealizado',
                    'UsuarioDesktop'=>'UsuarioDesktop',
                    'MessageWebService'=>'MessageWebService',
                ),
                ),
            );
        
        }
        /**
         *
         * @param ProcedimentoRealizado[] $procedimentoRealizado
         * @param UsuarioDesktop $usuario
         * @return ProcedimentoRealizado[]
         * @soap
         */
        public function enviarEmLoteProcedimentoRealizado($procedimentoRealizado, $usuario){
            $procedErros=array();   
            foreach ($procedimentoRealizado as $key => $pro) {
                if($this->save($pro)){
                    
                }
                else{
                 $procedErros[]=$pro;   
                }
            }
            return $procedErros;
        }
        
        /**
         *
         * @param ProcedimentoRealizado $procedimentoRealizado
         * @param UsuarioDesktop $usuario
         * @return boolean
         * @soap
         */
        public function enviarProcedimentoRealizado($procedimentoRealizado, $usuario){
            return $this->save($procedimentoRealizado);
        }        
        /**
         *
         * @param UsuarioDesktop $usuarioDesktop
         * @return MessageWebService[] $messageWebService
         * @soap 
         */
        public function getMessagesLastSend($usuarioDesktop){
            return array();
        }
        private function addMessageError($arrayMessages, $message,$tipo=MessageWebService::WARNING){
            $m= new MessageWebService();
            $m->tipo=$tipo;
            $m->message=$message;
            return $arrayMessages[]=$m;
        }
        
        private function save($procedReal){
            
                try{
                    $procedimentoRealizado= new ProcedimentoRealizado();
                    $paciente=new Paciente();

                    //preenche os objetos
                    $procedimentoRealizado->setProcedimentoRealizado($procedReal);
                    $procedimentoRealizado->setPaciente($procedReal->paciente);
                    $paciente->setPaciente($procedReal->paciente);

                    //coloca a data de atualização do usuário
                    $data=Date('Y-m-d h:i:s');
                    $paciente->ultima_atualizacao=$data;
                    $procedimentoRealizado->ultima_atualizacao=$data;
                    $trans=null;
                        try{
                            
                            //inicia uma transação
                            $trans=$procedimentoRealizado->dbConnection->beginTransaction();
                            //início para salvar o paciente
                            //-------------------------------------------------------------------
                            
                            //verifica se o usuário já está cadastrado no sistema
                            $cns=trim($paciente->cns);
                            $pacienteExiste=false;
                            $sizeCns=strlen($cns) ;
                            if($sizeCns == 15){
                                $paci=Paciente::model()->find('cns=:cns',array(':cns'=>$cns));
                                //verifica se o paciente já existe com um cns
                                if($paci!=null){
                                    $pacienteExiste=true;
                                    $paciente->id=$paci->id;
                                }
                            }
                            //o paciente não tem CNS ou não está cadastrado
                            if(!$pacienteExiste){
                                if($sizeCns !=15 ){
                                    $paciente->cns=null;   
                                }
                                //caso não salve o paciente
                                if(!$paciente->save()){
                                   foreach($paciente->getErrors() as $errors){
                                        foreach($errors as $error){  
                                           Yii::getLogger()->log("Erro ao salvar o paciente => ".$paciente->nome);
                                        }
                                    }
                                    //encerra o método e dá um rollaback
                                    Yii::getLogger()->log("Erro ao salvar o paciente => ");
                                    $trans->rollback();
                                    return false;
                                } 
                            }
                            //fim do código que salva o paciente
                            //----------------------------------------------------------------------
                            
                            
                            //início do código para salvar o procedimentoRealizado
                            //----------------------------------------------------------------------
                            //verifica se o paciente foi salvo com sucesso
                            if($paciente->id > 0){
                                //verifica se o procedimentoRealizado já foi enviado
                                $proced=ProcedimentoRealizado::model()->exists($procedimentoRealizado->getCriteriaPrimaryKey());
                                if(!$proced){
                                    $procedimentoRealizado->id_paciente=$paciente->id;
                                    if($procedimentoRealizado->save()){
                                        //conseguiu salvar o procedimentoRealizado e o paciente
                                        $trans->commit();
                                        return true;
                                    } 
                                    else{
                                        foreach($procedimentoRealizado->getErrors() as $errors){
                                            foreach($errors as $error){
                                                Yii::getLogger()->log("Erro ao salvar o procedimentoRealizado => ".$error);  
                                                
                                            }
                                        } 
                                        $trans->rollback();
                                        return false;
                                    }
                                }
                                else{
                                    //o procedimento já foi enviado
                                    Yii::getLogger()->log("Procedimento ja foi enviado=> unidade: ".$procedimentoRealizado->unidade.' competência: '.$procedimentoRealizado->competencia.' profissional cns: '.$procedimentoRealizado->profissional_cns.' profissional cbo: '.$procedimentoRealizado->unidade.' folha: '.$procedimentoRealizado->folha.' sequência: '.$procedimentoRealizado->sequencia);
                                    $trans->rollback();
                                    return true;
                                }
                            }
                            //-------------------------------------------------------------------------
                            //fim do código para salvar o procedimento
                            Yii::getLogger()->log("Deu bronca em paciente!");
                            $trans->rollback();
                            return false;
                        }catch(Exception $e){
                          if($trans!=null){
                              $trans->rollback();
                          }
                          Yii::getLogger()->log($e->getMessage()); 
                          
                          return false;
                        }
                    }catch (Exception $ex){
                        Yii::getLogger()->log($ex->getMessage()); 
                        return false;
                    }
            //deu erro em algum lugar
            return false;
        }
        /**
         *
         * @param ProcedimentoRealizado $procedimentoRealizado
         * @param UsuarioDesktop $usuarioDesktop 
         * @return boolean
         * @soap
         */
        public function atualizarProcedimentoRealizado($procedimentoRealizado, $usuarioDesktop){
            return $this->update($procedimentoRealizado);
        }
        
        /**
         *
         * @param ProcedimentoRealizado[] $procedimentoRealizado
         * @param UsuarioDesktop $usuarioDesktop 
         * @return ProcedimentoRealizado[]
         * @soap
         */
        public function atualizarEmLoteProcedimentoRealizado($procedimentoRealizado,$usuarioDesktop){
            $procedErros=array();   
            foreach ($procedimentoRealizado as $key => $pro) {
                if($this->update($pro)){
                    
                }
                else{
                 $procedErros[]=$pro;   
                }
            }
            return $procedErros;
        }
        
        /**
         * @param UsuarioDesktop $usuarioDesktop
         * @return boolean
         */
        public function login($usuarioDesktop){
            
        }
        
        /**
         *
         * @param UsuarioDesktop $usuarioDesktop 
         * @return boolean
         */
        public function logout($usuarioDesktop){
            
        }
        private function update($procedReal){
            
                try{
                    $procedimentoRealizado= new ProcedimentoRealizado();
                    $paciente=new Paciente();

                    //preenche os objetos
                    $procedimentoRealizado->setProcedimentoRealizado($procedReal);
                    
                    if(strlen($procedReal->paciente->cns)!=15){
                        $procedReal->paciente->cns=null;
                    }
                    $procedimentoRealizado->setPaciente($procedReal->paciente);
                    $paciente->setPaciente($procedReal->paciente);

                    //coloca a data de atualização 
                    $data=Date('Y-m-d h:i:s');
                    
                    $trans=null;
                        try{
                            //inicia uma transação
                            $trans=$procedimentoRealizado->dbConnection->beginTransaction();
                            //verifica se o procedimentoRealizado a ser atualizado existe
                            $proc=ProcedimentoRealizado::model()->find($procedimentoRealizado->getCriteriaPrimaryKey());
                            if($proc!=null){
                                //setta os novos dados
                                $proc->setProcedimentoRealizado($procedimentoRealizado);
                                $proc->setPaciente($procedimentoRealizado->paciente);
                                //registra a atualização
                                $proc->ultima_atualizacao=$data;
                                
                                //carrega o paciente ligado ao procedimento para poder salvar
                                $paciente->id=$proc->id_paciente ;
                                $pac=Paciente::model()->findByPk($paciente->id);
                                //paciente existe
                                if($pac!=null){
                                    //coloca os novos dados
                                    $pac->setPaciente($paciente);
                                    //registra a data de atualização
                                    $pac->ultima_atualizacao=$data;
                                    
                                    //tenta atualizar o paciente
                                    if( $pac->update() ){
                                        //vai atualizar o procedimentoRealizado
                                        if($proc->update()){

                                            $trans->commit();
                                            return true;
                                        }
                                        //Falha na atualização do procedimentoRealizado
                                        else{
                                            foreach($proc->getErrors() as $errors){
                                                foreach($errors as $error){
                                                    Yii::getLogger()->log("Erro ao salvar o procedimentoRealizado => ".$error);  

                                                }
                                            } 
                                            $trans->rollback();
                                            return false;
                                        }
                                    }
                                    //falha na atualização do paciente
                                    else{
                                        foreach($proc->getErrors() as $errors){
                                            foreach($errors as $error){
                                                Yii::getLogger()->log("Erro ao salvar o procedimentoRealizado => ".$error);  

                                            }
                                         } 
                                        $trans->rollback();
                                        return false;
                                    }
                                }
                                else{
                                    Yii::getLogger()->log("Paciente não existe");  
                                    $trans->rollback();
                                    return false;
                                }
                            }
                            Yii::getLogger()->log("Procedimento Realizado não existe");  
                            //ProcedimentoRealizado não existe
                            $trans->rollback();
                            return false;
                            //início para atualizar o paciente
                            //-------------------------------------------------------------------
        
                        }catch(Exception $e){
                          if($trans!=null){
                              $trans->rollback();
                          }
                          Yii::getLogger()->log($e->getMessage()); 
                          
                          return false;
                        }
                    }catch (Exception $ex){
                        Yii::getLogger()->log($ex->getMessage()); 
                        return false;
                    }
            //deu erro em algum lugar
            return false;
        }
}