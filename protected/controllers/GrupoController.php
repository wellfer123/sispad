<?php

class GrupoController extends SISPADBaseController {

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
    public function actionView($id) {
        $this->CheckAcessAction();
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->CheckAcessAction();
        $model = new Grupo;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Grupo'])) {
            $model->attributes = $_POST['Grupo'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->codigo));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->CheckAcessAction();
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Grupo'])) {
            $model->attributes = $_POST['Grupo'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->codigo));
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
        $this->CheckAcessAction();
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->CheckAcessAction();
        $dataProvider = new CActiveDataProvider('Grupo');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->CheckAcessAction();
        $model = new Grupo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Grupo']))
            $model->attributes = $_GET['Grupo'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Grupo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Grupo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Grupo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'grupo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionFindGrupos() {

        $this->_RBAC->checkAccess('registered', true);
        $q = $_GET['term'];

        if (isset($q)) {
            $grupos = Grupo::model()->findAll('nome like :nome', array(':nome' => '%' . strtoupper(trim($q)) . '%'));
            if (!empty($grupos)) {
                $out = array();
                foreach ($grupos as $s) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $s->nome,
                        'value' => $s->nome,
                        'id' => $s->codigo, // return value from autocomplete
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }

    protected function getModelName() {
        return "Grupo";
    }

}
