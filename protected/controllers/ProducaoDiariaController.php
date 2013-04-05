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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->CheckAcessAction();
        $servidor = $this->getServidor();
        $data = Date('d/m/Y');
        if ($this->podeEnviarProducao($data, $servidor->unidade->cnes)) {

            $especialidades = $this->getEspecialidades($servidor->unidade->cnes);
            //a unida tem especialidades
            if (!empty($especialidades)) {
                $itens = $this->getProducoesAEnviar($especialidades, $servidor, $data);

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);
                //existe uma requisição post
                if (isset($_POST['ProducaoDiaria'])) {
                    $valido = true;
                    //popula os modelos com os dados do formulário
                    foreach ($itens as $i => $value) {
                        if (isset($_POST['ProducaoDiaria'][$i])) {
                            $value->attributes = $_POST['ProducaoDiaria'][$i];
                            $value->data = ParserDate::inverteDataPtToEn($data);
                            //valida os dados
                            $valido = $value->validate() && $valido;
                        }
                    }
                    //todos os modelos são válidos
                    if ($valido) {
                        //vai inserir todos os modelos de uma vez
                        $dao = new ModelDao('ProducaoDiaria');
                        if ($dao->insertMultiple($itens)) {
                            //redireciona para a administração
                            $this->redirect(array(
                                'admin'
                            ));
                        }
                    }
                }
                //tem modelos inválidos ou fez a primeira requisição
                $this->render('create', array(
                    'data' => $data,
                    'itens' => $itens,
                    'especialidades' => $especialidades,
                    'servidor' => $servidor,
                ));
            //a unidade não tem especialidades,
            //então o sistema redireciona
            }else{
                $this->redirect(array('unidadeEspecialidade/add','unidade'=>$servidor->unidade->cnes)); 
            }
        } else {
            //verá os dados somente de sua unidade
            $this->redirect(array(
                'adminGestor'
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->getRBACManeger()->denyAccess();
        $servidor = $this->getServidor();
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProducaoDiaria'])) {
            $model->attributes = $_POST['ProducaoDiaria'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->unidade_cnes));
        }

        $this->render('update', array(
            'model' => $model,
            'especialidades' => $this->getEspecialidades(),
            'servidor' => $servidor,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->getRBACManeger()->denyAccess();
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
         $this->CheckAcessAction();
        $unidades = CHtml::listData(Unidade::model()->findAll(), 'cnes', 'nome');
        $especialidades = CHtml::listData($this->getEspecialidades(), 'codigo', 'nome');

        $model = new ProducaoDiaria('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProducaoDiaria']))
            $model->attributes = $_GET['ProducaoDiaria'];

        $this->render('admin', array(
            'model' => $model,
            'unidades' => $unidades,
            'especialidades' => $especialidades,
        ));
    }

    public function actionAdminGestor() {
        $this->CheckAcessAction();
        $unidades = CHtml::listData(Unidade::model()->findAll(), 'cnes', 'nome');
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
        $criteria->join = "INNER JOIN unidade_especialidade uni ON uni.profissao_codigo=prof.codigo";
        if ($unidade !== null) {
            $criteria->condition = ' uni.unidade_cnes=:cnes';
            $criteria->params = array(':cnes' => $unidade);
        } else {
           // $criteria->distinct = true;
        }

        $models = Profissao::model()->findAll($criteria); //' grupo_codigo IS NOT NULL AND grupo_codigo <> 0');
        return CHtml::listData($models, 'codigo', 'nome');
    }

    /**
     * 
     * @return Servidor servidor que está logado no sistema
     */
//    private function getServidor() {
//        return Servidor::model()->with('unidade')->find('cpf=:cpf', array(':cpf' => Yii::app()->user->cpfservidor));
//    }

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

    private function podeEnviarProducao($data, $unidade) {
        return !ProducaoDiaria::model()->exists('data=:data AND unidade_cnes=:unidade', array(
                    ':data' => ParserDate::inverteDataPtToEn($data),
                    ':unidade' => $unidade,
        ));
    }

    protected function getModelName() {
        return 'ProducaoDiaria';
    }

}
