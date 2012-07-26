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

        public function actionCreate()
	{
                //$this->CheckAcessAction();
                $model=new Item;



		//Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if((isset($_POST['Item']))&&(isset($_GET['meta_id'])))
		{

                       
                        $model->nome=$_POST['Item']['nome'];
                        $model->meta_id=$_GET['meta_id'];
			if($model->save()){
                            $model=new Item;
                            $this->addMessageSuccess("Item criado!");
                                 
                        }

                }

		$this->render('create',array(
			'model'=>$model
		));
        }

         public function actionList() {
            $model = new  Item();
            $this->render('list',array(
			'model'=>$model,
		));

        }

         public function actionFindItens() {

             $this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $itens = Item::model()->findAll('nome like :nome',array(':nome'=> strtoupper(trim($q)).'%'));

                if (!empty($itens)) {
                    $out = array();
                    foreach ($itens as $s) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $s->nome,
                            'value' => $s->nome,
                            'id' => $s->id, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
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

