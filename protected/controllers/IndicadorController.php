<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndicadorController
 *
 * @author Junior Pires
 */
class IndicadorController extends SISPADBaseController{
        public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;



        public function __construct($id, $module = null) {
            parent::__construct($id, $module);
        }

        public function filters()
	{
		return array(
			'accessControl',
		);
	}

        public function actionCreate() {
             $model=new Indicador();



		//Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Indicador']))
		{

                        $model->attributes=$_POST['Indicador'];

			if($model->save()){
                            $this->addMessageSuccess("Indicador criado!");
                                  $model=new Indicador();
                        }

                }

               



		$this->render('create',array(
			'model'=>$model
		));

        }

        public function actionAdmin()
	{
                //$this->CheckAcessAction();
		$model=new Indicador('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Indicador']))
			$model->attributes=$_GET['Indicador'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        protected function getModelName() {
            return 'Indicador';
    }

     protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='indicador-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
?>
