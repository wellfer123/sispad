<?php

class PacienteController extends SISPADBaseController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    private $format = 'application/json';

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
        $model = new Paciente;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Paciente'])) {
            $model->attributes = $_POST['Paciente'];
            if ($model->validate()) {
                $this->redirect('http://localhost:8080/sispadreport/');
            }

            //$this->redirect(array('view','id'=>$model->cns));
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
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Paciente'])) {
            $model->attributes = $_POST['Paciente'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->cns));
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
        $dataProvider = new CActiveDataProvider('Paciente');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionConsulta() {
        if (isset($_GET['cns'])) {
            $list = Paciente::model()->find('cns=:cns', array(':cns' => $_GET['cns']));
            $this->_sendResponse(200, CJSON::encode($list), $this->format);
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Paciente('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Paciente']))
            $model->attributes = $_GET['Paciente'];

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
        $model = Paciente::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'paciente-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionFindCns() {

        //$this->_RBAC->checkAccess('registered',true);
        $q = $_GET['term'];
        if (isset($q)) {
            $pesq = strtoupper(trim($q));
            $pacientes = Paciente::model()->findAll('(nome like :nome or cns like :cns) AND cns IS NOT NULL ', array(
                ':nome' => '%' . $pesq . '%',
                ':cns' => '%' . $pesq . '%'));

            if (!empty($pacientes)) {
                $out = array();
                foreach ($pacientes as $pac) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $pac->getCnsNome(),
                        'value' => $pac->getCnsNome(),
                        'id' => $pac->cns, // returna o cns
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }

    protected function getModelName() {
        return "Paciente";
    }

}
