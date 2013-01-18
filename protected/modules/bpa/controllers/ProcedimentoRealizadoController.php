<?php

class ProcedimentoRealizadoController extends Controller {

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
        $model = new ProcedimentoRealizado;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProcedimentoRealizado'])) {
            $model->attributes = $_POST['ProcedimentoRealizado'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->unidade));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionRelatorio() {
        $model = new ProcedimentoRealizado('search');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProcedimentoRealizado'])) {
            $model->attributes = $_POST['ProcedimentoRealizado'];
            if ($model->validate())
                $this->redirect('http://localhost:8080/sispadreport/teste?unidade=' . $model->unidade);
        }

        $this->render('relatorio', array(
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

        if (isset($_POST['ProcedimentoRealizado'])) {
            $model->attributes = $_POST['ProcedimentoRealizado'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->unidade));
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
        $dataProvider = new CActiveDataProvider('ProcedimentoRealizado');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ProcedimentoRealizado('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProcedimentoRealizado']))
            $model->attributes = $_GET['ProcedimentoRealizado'];

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
        $model = ProcedimentoRealizado::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'procedimento-realizado-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionTeste() {

        $xml = simplexml_load_file(dirname(__FILE__) . '/../../../files/bck.xml');
        echo $xml->getName() . '<br>';
        foreach ($xml->children() as $key => $value) {
            $pro = new ProcedimentoRealizado();
            $pro->paciente =new Paciente();
//                
//                    foreach ($value->children() as $key=>$value2){
//                        echo $value->{$key}.'<br>';
//                    }
            $this->preencherModeloXML($value, $pro);
            echo $pro->procedimento . '<br>';
            echo $pro->paciente->nome . '<br>';
        }
    }

    public function preencherModeloXML($elemento, $modelXML) {
        if ($modelXML instanceof XMLModel) {
            //caso base para recursividade
            if (!is_object($elemento)){
                return;
            }
            //pega os elementos filhos
            $children = $elemento->children();
            //verifica sem tem filhos
            if (count($children) > 0) {
                //pega os atributos para mapear
                $vet = $modelXML->getFileFieldsToModelAttributes();
                //percorre o filhos que sao as propriedades do objeto
                foreach ($children as $no => $value) {
                    //verifica se esse no tem outros
                    $size=count($value);
                    if ($size > 0) {
                        //recursividade
                        $this->preencherModeloXML($no, $modelXML);
                    } else {
                        $atributo = $vet[$no];
                        if ($atributo != null) {
                            //quebra o atributo, caso esse seja um objeto.
                            $t=explode('->', $atributo);
                            if(count($t) === 2 ){
                                $at=$modelXML->{$t[0]};
                                $at->{$t[1]}=$elemento->{$no};
                                $modelXML->{$t[0]}=$at;
                            }
                            else{
                                $modelXML->{$atributo} = $elemento->{$no};
                            }
                        }
                    }
                }
            }
        }
    }

}
