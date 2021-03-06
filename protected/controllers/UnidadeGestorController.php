<?php

class UnidadeGestorController extends SISPADBaseController {

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
        $model = new UnidadeGestor('create');


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['UnidadeGestor'])) {
            $model->attributes = $_POST['UnidadeGestor'];
            $model->ativo = UnidadeGestor::ATIVO;
            if ($model->save())
                $this->redirect(array('view', 'unidade_cnes' => $model->unidade_cnes, 'servidor_cpf' => $model->servidor_cpf));
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
    public function actionUpdate() {
        $this->CheckAcessAction();
        $model = $this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UnidadeGestor'])) {
            $model->attributes = $_POST['UnidadeGestor'];
            if ($model->save())
                $this->redirect(array('view', 'unidade_cnes' => $model->unidade_cnes, 'servidor_cpf' => $model->servidor_cpf));
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
    public function actionDelete() {
        $this->CheckAcessAction();
        $this->loadModel()->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->CheckAcessAction();
        $dataProvider = new CActiveDataProvider('UnidadeGestor');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->CheckAcessAction();
        $model = new UnidadeGestor('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UnidadeGestor']))
            $model->attributes = $_GET['UnidadeGestor'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionActive() {

        $this->CheckAcessAction();
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $mo = $this->loadModel();
            if ($mo != null) {
                $mo->ativo = UnidadeGestor::ATIVO;
                $mo->save();
                //$this->enviaEmail($mo->email,$mo->username,
                // "sispadcaruaru@gmail.com","ATIVACAO DE CONTA",$this->_bodyEmail);
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
            $mo = $this->loadModel();
            if ($mo != null) {

                $mo->ativo = UnidadeGestor::DESATIVO;
                $mo->save();
                //$this->enviaEmail($mo->email,$mo->username,
                // "sispadcaruaru@gmail.com","DESATIVACAO DE CONTA",$this->_bodyEmailDes);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return UnidadeGestor the loaded model
     * @throws CHttpException
     */
    public function loadModel() {
        $model = null;
        if (isset($_GET['unidade_cnes']) and isset($_GET['servidor_cpf'])) {
            $model = UnidadeGestor::model()->findByPk(array('unidade_cnes' => $_GET['unidade_cnes'], 'servidor_cpf' => $_GET['servidor_cpf']));
        }
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param UnidadeGestor $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'unidade-gestor-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getAllUnidadeGestor($cpf) {
        $criteria = new CDbCriteria;
        $criteria->condition = " gestor_cpf=" . $cpf;
        $dataProvider = new CActiveDataProvider('UnidadeGestor', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20
            )
        ));
        return $dataProvider;
    }

    protected function getModelName() {
        return "UnidadeGestor";
    }

}
