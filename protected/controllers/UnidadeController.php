<?php

class UnidadeController extends SISPADBaseController {

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
        //$this->_RBAC->denyAccess();
        $model = new Unidade;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Unidade'])) {
            $model->attributes = $_POST['Unidade'];
            if ($model->validate()) {
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->cnes));
            }
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

        if (isset($_POST['Unidade'])) {
            $model->attributes = $_POST['Unidade'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->cnes));
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
        //$this->_RBAC->checkAccess('manegeUnidade',true);
        /* $dataProvider=new CActiveDataProvider('Unidade');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          )); */
        $this->redirect(array('admin'));
    }

    public function actionList() {
        $this->CheckAcessAction();
        $dataProvider = new CActiveDataProvider('Unidade');
        $this->render('list', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->CheckAcessAction();
        $model = new Unidade('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Unidade']))
            $model->attributes = $_GET['Unidade'];

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
                $this->_model = Unidade::model()->with('cidade', 'regional')->findbyPk($_GET['id']);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'unidade-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionFindUnidades() {

        $this->_RBAC->checkAccess('registered', true);
        $q = $_GET['term'];
        if (isset($q)) {
            $pes = '%' . strtoupper(trim($q)) . '%';
            $unidades = Unidade::model()->findAll('nome like :nome OR cnes LIKE :nome', array(':nome' => $pes));

            if (!empty($unidades)) {
                $out = array();
                foreach ($unidades as $u) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $u->NomeDescricao,
                        'value' => $u->NomeDescricao,
                        'id' => $u->cnes, // return value from autocomplete
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }

    public function actionFindUnidadesCnes() {

        $this->_RBAC->checkAccess('registered', true);
        $q = $_GET['term'];
        if (isset($q)) {
            $pes = '%' . strtoupper(trim($q)) . '%';
            $unidades = Unidade::model()->findAll('nome  like :pesquisa or cnes like :pesquisa', array(':pesquisa' => $pes));

            if (!empty($unidades)) {
                $out = array();
                foreach ($unidades as $u) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $u->CnesNome,
                        'value' => $u->CnesNome,
                        'id' => $u->cnes, // return value from autocomplete
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }

    protected function getModelName() {
        return 'Unidade';
    }

}
