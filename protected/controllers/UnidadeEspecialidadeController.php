<?php

class UnidadeEspecialidadeController extends SISPADBaseController {

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
            array('deny',  // deny all users
		  'users'=>array('*'),
		 ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->getRBACManeger()->denyAccess();
        $model = new UnidadeEspecialidade;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UnidadeEspecialidade'])) {
            $model->attributes = $_POST['UnidadeEspecialidade'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->unidade_cnes));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionAdd($unidade) {
        $this->CheckAcessAction();
        $unidade = Unidade::model()->find('cnes=:cnes', array(':cnes' => $unidade));
        //verifica se a unidade existe
        if ($unidade !== null) {
            //cria o modelo
            $model = new UnidadeEspecialidade;

            $model->unidade_cnes = $unidade->cnes;
            //pega a lista de grupos
            $grupos = CHtml::listData(Grupo::model()->findAll(), 'codigo', 'nome');
            if (isset($_POST['UnidadeEspecialidade'])) {
                $model->attributes = $_POST['UnidadeEspecialidade'];
                
                if ($model->validate()){
                    //verifica se o o modelo não existe para pode salvar no banco de dados
                    $criteria= new CDbCriteria();
                    $criteria->alias='ue';
                    $criteria->condition='ue.profissao_codigo=:pro AND ue.unidade_cnes=:cnes';
                    $criteria->params=array(':pro'=>$model->profissao_codigo, ':cnes'=>$model->unidade_cnes);
                       
                    $exists=UnidadeEspecialidade::model()->exists($criteria);
                     //não existe, então salva 
                    if( ! $exists  ){
                       $model->save(); 
                    }
                    //redireciona
                    $this->redirect(array('unidadeEspecialidade/add','unidade'=>$unidade->cnes));
                }
            }
            //renderiza a página
            $this->render('add', array(
                'model' => $model,
                'unidade'=>$unidade,
                'grupos' => $grupos,
            ));
        }
        else{
           throw new CHttpException(404, 'A página requisitada não existe!');
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($unidade,$especialidade) {
        $this->getRBACManeger()->denyAccess();
        $this->loadModel($unidade,$especialidade)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }


    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->getRBACManeger()->denyAccess();
        $model = new UnidadeEspecialidade('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UnidadeEspecialidade']))
            $model->attributes = $_GET['UnidadeEspecialidade'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return UnidadeEspecialidade the loaded model
     * @throws CHttpException
     */
    public function loadModel($unidade,$especialidade) {
        $this->getRBACManeger()->denyAccess();
        $model = UnidadeEspecialidade::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param UnidadeEspecialidade $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'unidade-especialidade-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function getModelName() {
        return 'UnidadeEspecialidade';
    }

}
