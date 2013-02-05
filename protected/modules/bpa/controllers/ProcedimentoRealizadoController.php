<?php

class ProcedimentoRealizadoController extends SISPADBaseController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array();
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new ProcedimentoRealizado;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProcedimentoRealizado'])) {
            $model->attributes = $_POST['ProcedimentoRealizado'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->unidade));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionRelatorio() {
        $model = new ProcedimentoRealizado('search');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProcedimentoRealizado'])) {
            $model->attributes = $_POST['ProcedimentoRealizado'];
            if ($model->validate())
                $this->redirect('http://localhost:8080/sispadreport/teste?unidade=' . $model->unidade);
        }

        $this->render('relatorio', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProcedimentoRealizado'])) {
            $model->attributes = $_POST['ProcedimentoRealizado'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->unidade));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('ProcedimentoRealizado');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ProcedimentoRealizado('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProcedimentoRealizado']))
            $model->attributes = $_GET['ProcedimentoRealizado'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = ProcedimentoRealizado::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'procedimento-realizado-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function envio($competencia, $unidade) {
        try {
            $ReaderXML = new ReaderElementXMLToModel();
            $quebra = chr(13) . chr(10);
            $erros = 0;
            $errosPaciente = 0;
            $producaoDao = new ModelDao('ProcedimentoRealizado');
            $pacienteDao = new ModelDao('Paciente');
            $ids = array();
            $msg = array();
            //percorre o arquivo
            foreach ($_FILES as $fileName => $file) {
                //verifica se arquivo contém erros
                $msg = $this->envioValidarArquivo($file);
                if (count($msg) !== 0) {
                    $this->_sendResponse(200, CJSON::encode($msg), 'application/json');
                    return;
                }
                //vai popular os objetos e enviar
                $xml = simplexml_load_file($file['tmp_name']);
                //array com a produção
                $producao = array();
                $pacientes = array();
                foreach ($xml->children() as $key => $value) {
                    try {
                        //cria os objetos
                        $pro = new ProcedimentoRealizado();
                        $pro->paciente = new Paciente();
                        //datas de cadastro e ultima atualização
                        $pro->ultima_atualizacao = $pro->data_cadastro = $pro->paciente->ultima_atualizacao = $pro->paciente->data_cadastro = Date('Y-m-d h:i:s');
                        //prenche
                        $ReaderXML->preencherModeloXML($value, $pro);
                        //verifica se o paciente existe
                        ///===========================================================================
                        //$pac
                        $cns = trim($pro->paciente_cns);
                        $pacienteExiste = false;
                        $paci = null;
                        $size = strlen($cns);
                        if ($size != 15) {
                            $pro->paciente_cns = null;
                            $pro->paciente->cns = null;
                        } else {
                            $pro->paciente_cns = $cns;
                            $pro->paciente->cns = $cns;
                        }

                        if ($size == 15) {
                            $paci = Paciente::model()->find('cns=:cns', array(':cns' => $cns));
                            if ($paci !== null) {
                                $paci->setPaciente($pro->paciente);
                                //paciente deve ser atualizado
                                $pacienteExiste = true;
                                //primeiro set o id em procedimentoRealizado
                                $pro->id_paciente = $paci->id;
                                //pega os novos dados
                                $paci->setPaciente($pro->paciente);
                                //guardar o paciente no vetor para atualizar posteriormente
                                
                                 $pacientes[] = $paci;
                                
                            }
                        }
                        if (!$pacienteExiste) {
                            //paciente não tem CNS ou não está cadastrado ainda
                            $paci = $pro->paciente;
                            $paci->validate();
                            if (count($paci->getErrors()) === 0) {
                                if ($paci->save()) {
                                    //salvou com sucesso.
                                    $pro->paciente_cns = $paci->cns;
                                    $pro->id_paciente = $paci->id;
                                    //guarda o id, caso algum erro ocorra
                                    if ($size !== 15) {
                                        $ids[] = $paci->id;
                                    }
                                } else {
                                    $errosPaciente+=1;
                                }
                            } else {
                                $errosPaciente+=1;
                            }
                        }
                        //=============================================================================
                        //verifica os dados do procedimento
                        $pro->validate();
                        if (count($pro->getErrors()) == 0) {
                            $producao[] = $pro;
                        } else {
                            $erros+=1;
                        }
                        //um erro de leitura de arquivo
                    } catch (Exception $exce) {
                        $erros+=1;
                        Yii::log($exce->getMessage(), CLogger::LEVEL_ERROR);
                    }
                }//terminou o for que popula os objetos
                //vai salvar a produção no banco de dados
                //se não teve nenhum erro
                if ($errosPaciente === 0 && $erros === 0) {
                    //pegar conexão como banco
                    $con = Yii::app()->db;
                    $transac = $con->beginTransaction();
                    try {
                        //exclui a produção anterior, caso exista
                        ProcedimentoRealizado::model()->deleteAll('competencia=:competencia AND unidade=:unidade', array(':competencia' => $competencia, ':unidade' => $unidade));
                        //insere a produção
                        $producaoDao->insertMultiple($producao, $con);
                        //atualiza os dados dos pacientes
                        $pacientes=array_unique($pacientes);
                        if (count($pacientes) > 0) {

                            $pacienteDao->updatetMultiple($pacientes, array('id', 'cns'), $con);
                        }
                        //commita as modificações
                        $transac->commit();
                        $msg[] = new MessageWebService('BPAPRD011', 'Produção enviada com suceso!', MessageWebService::SUCESSO);
                    } catch (Exception $exc) {
                        Yii::log($exc->getMessage(), CLogger::LEVEL_ERROR);
                        //algum erro aconteceu, então deve reverter as modificações
                        //e excluir aqueles pacientes que são novos e sem CNS
                        $transac->rollback();
                        Paciente::deleteAllNovosESemCNS($ids);
                        $msg[] = new MessageWebService('BPAPRD012', 'Ops! Não foi possível armazenar a produção! Informe aos desenvoldedores do sistema ou tente novamente!', MessageWebService::ERRO);
                        $this->_sendResponse(200, CJSON::encode($msg), 'application/json');
                        return;
                    }
                }
                //contém erros ou do paciente ou da produção
                else {
                    $msg[] = new MessageWebService('BPAPRD001', 'Produção contém erros', MessageWebService::ERRO);
                    $msg[] = new MessageWebService('BPAPRD002', 'Pacientes com erro: ' . $errosPaciente, MessageWebService::ERRO);
                    $msg[] = new MessageWebService('BPAPRD003', 'Produção: ' . $erros, MessageWebService::ERRO);
                    $this->_sendResponse(200, CJSON::encode($msg), 'application/json');
                    return ;
                }
            }//fim do for de $_FILES
        } catch (Exception $ex) {
            $msg[] = new MessageWebService('BPAPRD004', 'Ops! Ocorreu um erro inesperado.! Informe aos desenvoldedores do sistema ou tente novamente!', MessageWebService::ERRO);
            Yii::log($ex->getMessage(), CLogger::LEVEL_ERROR);
            $this->_sendResponse(200, CJSON::encode($msg), 'application/json');
            return;
        }
        //envia as mensagens em JSON
        $this->_sendResponse(200, CJSON::encode($msg), 'application/json');
        return;
    }

    /**
     * Recebe o arquivo de produção do BPAI através de um post
     */
    public function actionEnvio() {
        
        //primeiro verifica se os parâmetros foram passados corretamente.
        try {
            if (isset($_POST['competencia']) && isset($_POST['unidade']) &&
                    isset($_POST['usuario']) && isset($_POST['senha'])) {
                //agora valida o login
                $res = $this->login($_POST['usuario'], $_POST['senha']);
                if (count($res) === 0) {
                    //continua
                    $res = $this->envioValidarCompetencia($_POST['competencia'], $_POST['unidade']);
                    if (count($res) === 0) {
                        //verifica se tem somente um arquivo na requisição
                        if (count($_FILES) === 1) {
                            //pode demorar muito
                            set_time_limit(0);
                            
                            //agora faz o envio
                            $this->envio($_POST['competencia'], $_POST['unidade']);
                        } else {

                            $msg = array();
                            $msg[] = new MessageWebService("BPAUPLOAD001", "Mais de arquivo foi enviado.", MessageWebService::ERRO);
                            $this->_sendResponse(200, CJSON::encode($msg), 'application/json');
                            return;
                        }
                    }
                    //erro na competência
                    else {
                        $this->_sendResponse(200, CJSON::encode($res), 'application/json');
                        return;
                    }
                }
                //login incorreto
                else {
                    $this->_sendResponse(200, CJSON::encode($res), 'application/json');
                    return;
                }
            } else {
                $msg = array();
                $msg[] = new MessageWebService("BPAPARAMETROS001", "Falta parâmetros na requisição. Informe aos desenvolvedores do sistema o problema.", MessageWebService::ERRO);
                $this->_sendResponse(200, CJSON::encode($msg), 'application/json');
                return;
            }
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), CLogger::LEVEL_ERROR);
            $msg = array();
            $msg[] = new MessageWebService("BPA001", "Falta parâmetros na requisição. Informe aos desenvolvedores do sistema o problema.", MessageWebService::ERRO);
            $this->_sendResponse(200, CJSON::encode($msg), 'application/json');
        }
    }

    /**
     *
     * @param type $erro codigo do erro http
     * @return MessageWebService[] vazio se não tiver nenhum erro.
     */
    private function getErroUpload($erro) {
        $message[] = array();
        switch ($erro) {
            case UPLOAD_ERR_CANT_WRITE:
                $message[] = new MessageWebService("BPAUPLOAD011", "Servidor sem permissão para escrita! Informe aos desenvolvedores.", MessageWebService::ERRO);
                break;
            case UPLOAD_ERR_INI_SIZE:
                $message[] = new MessageWebService("BPAUPLOAD012", "Arquivo muito grande!", MessageWebService::ERRO);
                break;
            case UPLOAD_ERR_PARTIAL:
                $message[] = new MessageWebService("BPAUPLOAD013", "O upload do arquivo foi feito parcialmente. Tente novamente.", MessageWebService::ERRO);
                break;
            case UPLOAD_ERR_NO_FILE:
                $message[] = new MessageWebService("BPAUPLOAD014", "O upload do arquivo não foi feito. Tente novamente", MessageWebService::ERRO);
                break;
            default:
                $message[] = new MessageWebService("BPAUPLOAD015", "Erro não identificado no arquivo!", MessageWebService::ERRO);
                break;
        }
        return $message;
    }

    /**
     *
     * @param string $competencia no formato anomes (201212)
     * @param string $cnes da unidade
     * @return MessageWebService[] vazio se não tiver nenhum erro. 
     */
    private function envioValidarCompetencia($competencia, $cnes) {
        $msg = array();
        //prefixo do codigo do erro
        $com = Competencia::model()->findByPk(Competencia::inverterCompetenciaMesAno($competencia));
        $unidade = Unidade::model()->findByPk($cnes);
        //valida a competência
        if ($com === null) {
            $msg[] = new MessageWebService("BPACMP011", "Competência inexistente!", MessageWebService::ERRO);
        } else if (!$com->isAberta()) {
            $msg[] = new MessageWebService("BPACMP012", "A competência está fechada para o envio de produção!", MessageWebService::ERRO);
        }
        //
        if ($unidade === null) {
            $msg[] = new MessageWebService("BPACMP013", "A unidade não está cadastrada!", MessageWebService::ERRO);
        }
        return $msg;
    }

    private function login($usuario, $senha) {
        $msg = array();
        $user = User::model()->find('username=:user', array(':user' => strtoupper($usuario)));

        if ($user === null) {
            $msg[] = new MessageWebService("BPALOGIN011", "Usuário não encontrado. Informe aos desenvolvedores do sistema!", MessageWebService::ERRO);
        } else if ($user->password !== MD5($senha)) {
            $msg[] = new MessageWebService("BPALOGIN011", "Senha incorreta. Informe aos desenvolvedores do sistema!", MessageWebService::ERRO);
        }
        return $msg;
    }

    private function envioValidarArquivo($arquivo) {
        $msg = array();
        //verifica a extensão do arquivo
        $temp = explode('.', $arquivo['name']);
        // não é um arquivo XML
        if ($temp[1] != 'xml') {
            return $msg[] = new MessageWebService("BPAARQUIVO001", "Envie um arquivo XML!", MessageWebService::ERRO);
        }
        //verifica se contém algum erro durante o upload
        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            //recebe um vetor
            $msg = $this->getErroUpload($arquivo['error']);
            return $msg;
        }
    }

    protected function getModelName() {
        return "ProcedimentoRealizado";
    }

}
