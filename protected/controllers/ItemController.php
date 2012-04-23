<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemController
 *
 * @author Junior Pires
 */
class ItemController extends SISPADBaseController {
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

        public function actionCreate()
	{
                //$this->CheckAcessAction();
                $model=new Item;



		//Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Item']))
		{

                        $model->attributes=$_POST['Item'];
			if($model->save()){
                            $model=new Item;
                            $this->addMessageSuccess("Item criado!");
                                 
                        }

                }

		$this->render('create',array(
			'model'=>$model
		));
        }

        protected function getModelName() {
            return 'Item';
        }

         protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
?>
