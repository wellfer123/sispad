<?php

class FaltaController extends SISPADBaseController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
        return array(
                /* array('allow',  // allow all users to perform 'index' and 'view' actions
                  'actions'=>array('index','view'),
                  'users'=>array('*'),
                  ),
                  array('allow', // allow authenticated user to perform 'create' and 'update' actions
                  'actions'=>array('create','update'),
                  'users'=>array('@'),
                  ),
                  array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions'=>array('admin','delete'),
                  'users'=>array('admin'),
                  ),
                  array('deny',  // deny all users
                  'users'=>array('*'),
                  ), */
        );
    }

    /**
     * Displays a particular model.
     */
    public function actionViewDetail() {
        $this->CheckAcessAction();
        $model = new Falta;
        $this->render('view_detail', array(
            'model' => $model,
        ));
    }

    public function actionViewMonth() {
        $this->CheckAcessAction();
        $model = new Falta;

        $this->render('view_month', array(
            'model' => $model,
        ));
    }

    public function actionPreparedCreate() {
        $this->CheckAcessAction();
        $model = new Falta('preparedCreate');

        $this->performAjaxValidation($model);
        if (isset($_POST['Falta'])) {
            $model->servidor_cpf = $_POST['Falta']['servidor_cpf'];
            $model->mes = $_POST['Falta']['mes'];
            $model->ano = $_POST['Falta']['ano'];

            if ($model->validate()) {

                $this->redirect(array('create', 'cpf' => $model->servidor_cpf, 'mes' => $model->mes,
                    'ano' => $model->ano));
            }
        }
        $this->render('prepared_create', array(
            'model' => $model,
        ));
    }

    public function actionPreparedViewDetail() {
        $this->CheckAcessAction();
        $model = new Falta('viewDetail');

        $this->performAjaxValidation($model);
        if (isset($_POST['Falta'])) {
            $model->servidor_cpf = $_POST['Falta']['servidor_cpf'];
            $model->mes = $_POST['Falta']['mes'];
            $model->ano = $_POST['Falta']['ano'];
            if ($model->validate()) {
                $this->redirect(array('viewDetail', 'cpf' => $model->servidor_cpf, 'mes' => $model->mes,
                    'ano' => $model->ano));
            }
        }
        $this->render('prepared_view_detail', array(
            'model' => $model,
        ));
    }

    public function actionPreparedViewMonth() {
        $this->CheckAcessAction();
        $model = new Falta;
        $servidor = new Servidor('preparedViewMonth');

        $this->performAjaxValidation($model);
        if (isset($_POST['Falta'])) {

            $model->mes = $_POST['Falta']['mes'];
            $model->ano = $_POST['Falta']['ano'];
            $servidor->unidade_cnes = $_POST['Servidor']['unidade_cnes'];
            $nome_unidade = $_POST['Servidor_unidade_cnes_lookup'];
            if ($model->validate() && $servidor->validate()) {
                $this->redirect(array('viewMonth', 'mes' => $model->mes,
                    'ano' => $model->ano, 'unidade' => $servidor->unidade_cnes, 'nome_unidade' => $nome_unidade));
            }
        }

        $this->render('prepared_view_month', array('servidor' => $servidor,
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->CheckAcessAction();
        $model = new Falta('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->servidor_cpf = $_GET['cpf'];
        $model->mes = $_GET['mes'];
        $model->ano = $_GET['ano'];
        $model->data_envio = date('Y-m-d');

        if (isset($_POST['Falta'])) {
            //$model->attributes=$_POST['Falta'];
            $model->dia = $_POST['Falta']['dia'];
            $model->motivo_id = $_POST['Falta']['motivo_id'];
            $model->obs_motivo = $_POST['Falta']['obs_motivo'];
            if ($model->save()) {
                $this->addMessageSuccess('Falta enviada com Sucesso!');
                //$this->redirect(array('create','cpf'=>$model->servidor_cpf,'mes'=>$model->mes,
                // 'ano'=>$model->ano));
            }
            else
                $this->addMessageErro('Falta não enviada!');
            //$this->redirect(array('view','id'=>$model->dia));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionRelatorioDetalhado($title, $servidorCpf, $mes, $ano) {
        $model = new Falta;
        $this->widget('application.extensions.phpexcel.EExcelView', array('dataProvider' => $model->searchPorServidor2($servidorCpf, $mes, $ano),
            'title' => $title,
            'grid_mode' => 'export',
            'exportType' => 'Excel2007',
        ));
        Yii::app()->end();
    }

    public function actionRelatorioMensal($title, $mes, $ano, $unidade_cnes) {
        $model = new TotalFalta;
        $this->widget('application.extensions.phpexcel.EExcelView', array('dataProvider' => $model->searchMensal2($mes, $ano, $unidade_cnes),
            'title' => $title,
            'grid_mode' => 'export',
            'exportType' => 'Excel2007',
        ));
        Yii::app()->end();
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        $this->CheckAcessAction();
        $model = $this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Falta'])) {
            $model->attributes = $_POST['Falta'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->dia));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        $this->CheckAcessAction();
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel()->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Falta');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Falta('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['falta']))
            $model->attributes = $_GET['falta'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = Falta::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'falta-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function getModelName() {
        return 'Falta';
    }

}
