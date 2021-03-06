<?php

class EspecialidadeGrupoController extends SISPADBaseController {

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
        $model = new EspecialidadeGrupo('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);


        if (Yii::app()->user->getState('especialidade') != null) {
            //pega o valor do último codigo da especialidade digitada
            $model->profissao_codigo = Yii::app()->user->getState('especialidade');
            //após isso apaga o valor da especialidade da sessao
            Yii::app()->user->setState('especialidade', null);
        }
        if (isset($_POST['EspecialidadeGrupo'])) {
            $model->attributes = $_POST['EspecialidadeGrupo'];
            if ($model->save()) {
                //guarda o codigo da especialidade que acabou de ser digitada em sessao
                Yii::app()->user->setState('especialidade', $model->profissao_codigo);
                $this->redirect(array('create'));
            }
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

        if (isset($_POST['EspecialidadeGrupo'])) {
            $model->attributes = $_POST['EspecialidadeGrupo'];
            if ($model->save())
                $this->redirect(array('view', 'profissao_codigo' => $model->profissao_codigo, 'grupo_codigo' => $model->grupo_codigo));
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
        $dataProvider = new CActiveDataProvider('EspecialidadeGrupo');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->CheckAcessAction();
        $model = new EspecialidadeGrupo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['EspecialidadeGrupo']))
            $model->attributes = $_GET['EspecialidadeGrupo'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return EspecialidadeGrupo the loaded model
     * @throws CHttpException
     */
    public function loadModel() {
        $model = null;
        if (isset($_GET['profissao_codigo']) and isset($_GET['grupo_codigo'])) {
            $model = EspecialidadeGrupo::model()->findByPk(array('profissao_codigo' => $_GET['profissao_codigo'], 'grupo_codigo' => $_GET['grupo_codigo']));
        }
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param EspecialidadeGrupo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'especialidade-grupo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function getModelName() {
        return 'EspecialidadeGrupo';
    }

}
