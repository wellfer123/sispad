<?php

class ProfissionalVinculoController extends SISPADBaseController {

    public $layout = '//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    protected function getModelName() {
        return 'ProfissaoVinculo';
    }

    public function actionIndex() {
        $this->render('index');
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
        $model = new ProfissionalVinculo('create');
        $servidor = $this->getServidor();
        $unidades = Unidade::findAllPorGestor($servidor);
        //o servidor é gestor de alguma unidade
        if (count($unidades) > 0) {
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['ProfissionalVinculo'])) {
                $model->attributes = $_POST['ProfissionalVinculo'];
                if ($model->save())
                    $this->redirect(array('create'));
            }
            $dataProvider = $this->getAllProfissionaisUnidade($unidades);
            $this->render('create', array('dataProvider' => $dataProvider, 'model' => $model, 'unidades' => $unidades));
        }
        else {
            throw new CHttpException(404, 'Você não é gestor de nenhuma unidade!');
        }
    }

    public function getAllProfissionaisUnidade($unidades) {
        $this->_RBAC->checkAccess('registered',true);
        $criteria=  ProfissionalVinculo::getProfissionais(CHtml::listData($unidades, 'cnes', 'nome'));
        $criteria->with=array('servidor','unidade','profissao');
        $dataProvider = new CActiveDataProvider('ProfissionalVinculo', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30
            )
        ));
        return $dataProvider;
    }

    public function actionActive() {

        $this->CheckAcessAction();
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $mo = $this->loadModel();
            if ($mo != null) {
                $mo->ativo = ProfissionalVinculo::ATIVO;
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

                $mo->ativo = ProfissionalVinculo::DESATIVO;
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

    public function loadModel() {
        if (isset($_GET['unidade_cnes']) and isset($_GET['cpf']) and isset($_GET['codigo_profissao'])) {
            $model = ProfissionalVinculo::model()->findByPk(array('unidade_cnes' => $_GET['unidade_cnes'], 'cpf' => $_GET['cpf'], 'codigo_profissao' => $_GET['codigo_profissao']));
        }
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}