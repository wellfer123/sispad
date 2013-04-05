<?php

class ProducaoDiariaController extends SISPADBaseController {

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
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($u, $d, $e) {
        $this->CheckAcessAction();
        $this->render('view', array(
            'model' => $this->loadModel($u, $e, $d),
        ));
    }

//    /**
//     * Creates a new model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     */
//    public function actionCreate() {
//        $this->CheckAcessAction();
//        $servidor = $this->getServidor();
//        $data = Date('d/m/Y');
//        if ($this->podeEnviarProducao($data, $servidor->unidade->cnes)) {
//
//            $especialidades = $this->getEspecialidades($servidor->unidade->cnes);
//            //a unida tem especialidades
//            if (!empty($especialidades)) {
//                $itens = $this->getProducoesAEnviar($especialidades, $servidor, $data);
//
//                // Uncomment the following line if AJAX validation is needed
//                // $this->performAjaxValidation($model);
//                //existe uma requisição post
//                if (isset($_POST['ProducaoDiaria'])) {
//                    $valido = true;
//                    //popula os modelos com os dados do formulário
//                    foreach ($itens as $i => $value) {
//                        if (isset($_POST['ProducaoDiaria'][$i])) {
//                            $value->attributes = $_POST['ProducaoDiaria'][$i];
//                            $value->data = ParserDate::inverteDataPtToEn($data);
//                            //valida os dados
//                            $valido = $value->validate() && $valido;
//                        }
//                    }
//                    //todos os modelos são válidos
//                    if ($valido) {
//                        //vai inserir todos os modelos de uma vez
//                        $dao = new ModelDao('ProducaoDiaria');
//                        if ($dao->insertMultiple($itens)) {
//                            //redireciona para a administração
//                            $this->redirect(array(
//                                'adminGestor'
//                            ));
//                        }
//                    }
//                }
//                //tem modelos inválidos ou fez a primeira requisição
//                $this->render('create', array(
//                    'data' => $data,
//                    'itens' => $itens,
//                    'especialidades' => $especialidades,
//                    'servidor' => $servidor,
//                ));
//                //a unidade não tem especialidades,
//                //então o sistema redireciona
//            } else {
//                $this->redirect(array('unidadeEspecialidade/add', 'unidade' => $servidor->unidade->cnes));
//            }
//        } else {
//            //verá os dados somente de sua unidade
//            $this->redirect(array(
//                'adminGestor'
//            ));
//        }
//    }

    /**
     * Creates a new model.
     * 
     */
    public function actionSend() {
        $this->CheckAcessAction();

        $servidor = $this->getServidor();
        $unidades = $this->getUnidades($servidor);
        $cnes = $unidades[0]->cnes;
        //pega pela primeira unidade
        $especialidades = $this->getEspecialidades($cnes);
        if (!empty($especialidades)) {//verifica se a unidade tem especialidades
            //declaração de variáveis
            $model = new ProducaoDiaria;
            $data = Date('d/m/Y');
            $model->data = $data;

            if (isset($_POST['ProducaoDiaria'])) { //verifica se existe uma requisição post
                //popula o modelo
                $model->attributes = $_POST['ProducaoDiaria'];

                if ($model->validate()) { //valida o modelo
                    $exist = $this->existeProducao($model);
                    if (!$exist) { //verifica se o modelo existe no banco de dados
                        if ($this->existeEspecialidadeUnidadeEProfissional($model)) {//verifica se a quantidade de especialidades da unidade
                            $model->data = ParserDate::inverteDataPtToEn($model->data);
                            if ($model->save()) { //salvou com sucesso, cria um novo modelo
                                $model = new ProducaoDiaria;
                                $model->data = $data;
                                //salvou com sucesso a produção
                                $this->addMessageSuccess("Produção enviada com sucesso!");
                            }
                            //não salvou
                            else {
                                $this->addMessageErro("Erro. Não foi possível enviar essa produção!");
                            }
                        } else {
                            $this->addMessageErro("Erro. Você já enviou a produção para a especialidade escolhida!");
                        }
                    } else {//exibe uma mensagem para o usuário
                        $this->addMessageInfo("Você já enviou esta produção!");
                    }
                }
            }
            //coloca os valores que são adminsitrados pelo sistema
            $model->servidor_cpf = $servidor->cpf;
            $model->unidade_cnes = $cnes;
            //pega os profissionais da unidade  
            $profissionais = $this->getProfissionais($cnes, $especialidades[0]->codigo);

            $grupos = Grupo::model()->findAll();
            //renderiza a página
            $this->render('send', array(
                'model' => $model,
                'data' => $data,
                'unidades' => $unidades,
                'grupos' => $grupos,
                'profissionais' => $profissionais,
                'especialidades' => $especialidades,
                'servidor' => $servidor,
            ));
            //a unidade não tem especialidades,
            //então o sistema redireciona
        } else {
            $this->redirect(array('unidadeEspecialidade/add', 'unidade' => $servidor->unidade->cnes));
        }
    }
    
    public function actionUpdateProducoes(){
        if (Yii::app()->request->isAjaxRequest){
            
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->CheckAcessAction();
        $criteria = new CDbCriteria();
        $criteria->order = ' nome';
        $unidades = CHtml::listData(Unidade::model()->findAll($criteria), 'cnes', 'nome');
        $especialidades = CHtml::listData($this->getEspecialidades(), 'codigo', 'nome');

        $model = new ProducaoDiaria('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProducaoDiaria'])) {
            $model->attributes = $_GET['ProducaoDiaria'];
            if ($model->data != null) {
                $model->data = ParserDate::inverteDataPtToEn($model->data);
            }
        }

        $this->render('admin', array(
            'model' => $model,
            'unidades' => $unidades,
            'especialidades' => $especialidades,
        ));
    }

    public function actionFindEspecialidades() {
        if (isset($_POST['unidade'])) {
            $data = CHtml::listData($this->getEspecialidades($_POST['unidade']), 'codigo', 'nome');
            foreach ($data as $value => $name) {
                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            }
        }
    }

    public function actionFindProfissionais() {

        if (isset($_POST['cnes']) && isset($_POST['cbo'])) {
            $pro = $this->getProfissionais($_POST['cnes'], $_POST['cbo']);
            $data = CHtml::listData($pro, 'cpf', 'servidor.nome');
            //print_r($pro);
            foreach ($data as $value => $name) {

                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            }
        }
    }

    public function actionAdminGestor() {
        $this->CheckAcessAction();
        $criteria = new CDbCriteria();
        $criteria->order = ' nome';
        $unidades = CHtml::listData(Unidade::model()->findAll($criteria), 'cnes', 'nome');
        $especialidades = CHtml::listData(Profissao::model()->findAll(), 'codigo', 'nome');

        $model = new ProducaoDiaria('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProducaoDiaria'])) {
            $model->attributes = $_GET['ProducaoDiaria'];
        }
        //filtra pelo servidor logado
        $model->servidor_cpf = Yii::app()->user->cpfservidor;
        $this->render('adminGestor', array(
            'model' => $model,
            'unidades' => $unidades,
            'especialidades' => $especialidades,
        ));
    }

    public function actionTeste() {
        $this->layout = '//layouts/column1';

        $unidades = CHtml::listData(Unidade::model()->findAll(), 'cnes', 'nome');
        $especialidades = $this->getEspecialidades();

        $model = new ProducaoMensalModel('search');
        $model->unsetAttributes();
        if (isset($_GET['ProducaoMensalModel'])) {
            $model->attributes = $_GET['ProducaoMensalModel'];
        }

        $this->render('monthHistory', array('model' => $model, 'unidades' => $unidades, 'especialidades' => $especialidades));
    }

    public function actionTeste2() {
        $this->layout = '//layouts/column1';

        $criteria = new CDbCriteria();
        $criteria->order = ' nome';
        $unidades = CHtml::listData(Unidade::model()->findAll($criteria), 'cnes', 'nome');

        $model = new ProducaoConsolidadaModel('search');
        $model->unsetAttributes();

        if (isset($_GET['ProducaoConsolidadaModel'])) {
            $model->attributes = $_GET['ProducaoConsolidadaModel'];
            if ($model->data != null) {
                $model->data = ParserDate::inverteDataPtToEn($model->data);
            }
        }
        if ($model->data == null) {
            $model->data = Date('Y-m-d');
        }
        $this->render('consolidadaGrupo', array('model' => $model, 'unidades' => $unidades));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ProducaoDiaria the loaded model
     * @throws CHttpException
     */
    public function loadModel($u, $e, $d) {
        $model = ProducaoDiaria::model()->findByPk(array(
            'unidade_cnes' => $u,
            'profissao_codigo' => $e,
            'data' => $d,
        ));
        if ($model === null)
            throw new CHttpException(404, 'A página requisitada não existe!' . " $u $e $d ");
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ProducaoDiaria $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'producao-diaria-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 
     * @return array map com o código e descrição de cada especialidade que tem um grupo
     */
    private function getEspecialidades($unidade = null) {

        $criteria = new CDbCriteria();
        $criteria->alias = 'prof';
        $criteria->join = "INNER JOIN profissional_vinculo pv ON pv.codigo_profissao=prof.codigo";
        if ($unidade != null) {
            $criteria->condition = ' pv.unidade_cnes=:cnes';
            $criteria->params = array(':cnes' => $unidade);
        } else {
            // $criteria->distinct = true;
        }

        $models = Profissao::model()->findAll($criteria); //' grupo_codigo IS NOT NULL AND grupo_codigo <> 0');
        return $models;
    }

    public function getProfissionais($cnes, $cbo = null) {
        //pega os profissionais da unidade  
        $criteria = new CDbCriteria();

        $criteria->alias = 'pv';
        $params = array(':cnes' => $cnes);
        if ($cbo != null) {
            $params[':cbo'] = $cbo;
            $criteria->condition = 'pv.unidade_cnes=:cnes AND pv.codigo_profissao=:cbo';
        } else {
            $criteria->condition = 'pv.unidade_cnes=:cnes';
        }
        $criteria->params = $params;
        //$criteria->order='servidor.nome';
        //pega os dados para preencher o combobox
        return $profi = ProfissionalVinculo::model()->with('servidor')->findAll($criteria);
    }

    /**
     * 
     * @param array $especialidades
     * @param Servidor $servidor
     * @param Date $data data no formato dd/mm/aaaa
     * @return ProducaoDiaria[]
     */
    private function getProducoesAEnviar($especialidades, $servidor, $data) {
        $pro = array();
        foreach ($especialidades as $key => $value) {
            $p = new ProducaoDiaria;
            $p->profissao_codigo = $key;
            $p->data = $data;
            $p->servidor_cpf = $servidor->cpf;
            $p->unidade_cnes = $servidor->unidade->cnes;
            $pro[] = $p;
        }
        return $pro;
    }

    /**
     * Verifica se a produção diária pode ser enviada com base na data.
     * Se somente a data for fornecida verifica se ela é a de hoje ou de ontem.
     * Caso contrário vai verifica se existe alguma produção daquela unidade na data fornecida
     * @param Date $data no formato brasileiro dd/mm/aaaa
     * @param string $unidade  (opcional)cnes da unidade
     * @return boolean true se pode enviar e false caso contrário
     */
    private function podeEnviarProducao($data, $unidade = null) {
        if (!$unidade == null) {
            return $data != null ? true : false;
        }
        return !ProducaoDiaria::model()->exists('data=:data AND unidade_cnes=:unidade', array(
                    ':data' => ParserDate::inverteDataPtToEn($data),
                    ':unidade' => $unidade,
        ));
    }

    /**
     * 
     * @param ProducaoDiaria $model
     * @return boolean true se o modelo pasado já foi enviado e false caso conttrário
     */
    private function existeProducao($model) {
        //verifica pela chave primária
        $criteria = new CDbCriteria();
        $criteria->condition = 'profissao_codigo=:prof AND unidade_cnes=:cnes AND profissional_cpf=:cpf AND data=:data';
        $criteria->params = array(
            ':prof' => $model->profissao_codigo,
            ':cnes' => $model->unidade_cnes,
            ':data' => ParserDate::inverteDataPtToEn($model->data),
            ':cpf' => $model->profissional_cpf);
        return ProducaoDiaria::model()->exists($criteria);
    }

    /**
     * Verifica se a quantidade
     * @param Producaodiaria $model
     */
    private function existeEspecialidadeUnidadeEProfissional($model) {
        $profiVinc= ProfissionalVinculo::model()->find('unidade_cnes=:cnes AND codigo_profissao=:codigo AND cpf=:cpf',
                    array(
                        ':cnes' => $model->unidade_cnes,
                        ':codigo' => $model->profissao_codigo,
                        ':cpf'=> $model->profissional_cpf,
                    ));
        return $profiVinc != null ? count($profiVinc) > 0 : false; 
        
//        //vai pegar a especialidade
//        $especialidade = UnidadeEspecialidade::model()->find('unidade_cnes=:cnes AND profissao_codigo=:codigo', array(
//            ':cnes' => $model->unidade_cnes,
//            ':codigo' => $model->profissao_codigo,
//        ));
//        //pega as producões já enviada para uma determinada especialidade em uma unidade
//        if ($especialidade != null) {
//            $criteria = new CDbCriteria();
//            $criteria->condition = 'profissao_codigo=:prof AND unidade_cnes=:cnes AND data=:data';
//            $criteria->params = array(
//                ':prof' => $model->profissao_codigo,
//                ':cnes' => $model->unidade_cnes,
//                ':data' => ParserDate::inverteDataPtToEn($model->data));
//            $producoes = ProducaoDiaria::model()->findAll($criteria);
//
//            if (empty($producoes)) {
//                return true;
//            } else {
//                Yii::log("passou na validação de produções");
//                return count($producoes) < $especialidade->quantidade;
//            }
//        }
//
//        return false;
    }

    /**
     * 
     * @param type $servidor
     * @return array com todas as unidades que o servidor passado como parâmetro é gestor
     */
    public function getUnidades($servidor) {
        $unidades = array();
        $unidades[] = $servidor->unidade;
        return $unidades;
    }

    protected function getModelName() {
        return 'ProducaoDiaria';
    }

}
