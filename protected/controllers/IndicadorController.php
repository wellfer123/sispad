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
        public $layout='//layouts/column1';

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
		//$this->performAjaxValidation($model);

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

        protected function getModelName() {
            return 'Indicador';
    }
}
?>
