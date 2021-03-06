<?php

class CompetenciaController extends SISPADBaseController {

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
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array();
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
        $model = new Competencia();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Competencia'])) {
            $model->attributes = $_POST['Competencia'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->mes_ano));
        }

        $this->render('create', array(
            'model' => $model,
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

        if (isset($_POST['Competencia'])) {
            $model->attributes = $_POST['Competencia'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->mes_ano));
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
        $this->CheckAcessAction();
        $dataProvider = new CActiveDataProvider('Competencia');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->CheckAcessAction();
        $model = new Competencia('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Competencia']))
            $model->attributes = $_GET['Competencia'];

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
                $this->_model = Competencia::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    public function actionActive() {
        $this->CheckAcessAction();
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            //Yii::log($_POST['id'].' ai get '.$_GET['id']);
            $mo = $this->loadModel();
            if ($mo != null) {
                $mo->ativo = Competencia::ABERTA;
                if ($mo->save()) {
                    Competencia::model()->updateAll(array('ativo' => Competencia::FECHADA), 'mes_ano<>:mes_ano', array(':mes_ano' => $mo->mes_ano));
                }
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionInactive() {
        $this->CheckAcessAction();
        if (Yii::app()->request->isPostRequest) {
            // we only allow  via POST request
            $mo = $mo = $this->loadModel();
            if ($mo != null) {
                $mo->ativo = Competencia::FECHADA;
                $mo->save();
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'competencia-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function getModelName() {
        return 'Competencia';
    }

}
