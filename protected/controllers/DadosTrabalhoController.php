<?php

class DadosTrabalhoController extends SISPADBaseController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $this->CheckAcessAction();
        $this->render('view', array(
            'model' => $this->loadModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->CheckAcessAction();
        $model = new DadosTrabalho('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->servidor_cpf = $_GET['id'];
        if (isset($_POST['DadosTrabalho'])) {
            $model->attributes = $_POST['DadosTrabalho'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->servidor_cpf));
        }

        $this->render('create', array(
            'model' => $model, 'serv' => $_GET['serv']
        ));
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

        if (isset($_POST['DadosTrabalho'])) {
            $model->attributes = $_POST['DadosTrabalho'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->servidor_cpf));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id'])) {
                $this->_model = DadosTrabalho::model()->with('profissao', 'servidor')->findbyPk($_GET['id']);
                if ($this->_model === null) {
                    $this->redirect(array('create', 'id' => $_GET['id'], 'serv' => $_GET['serv']));
                }
            } else {
                throw new CHttpException(404, 'Servidor não existente no sistema.');
            }
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'dados-trabalho-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function getModelName() {
        return 'DadosTrabalho';
    }

}
