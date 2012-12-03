<?php

class ProcedimentoAmbulatorialController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
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
        
        
         public function actionFindProcedimentos() {
            
            //$this->_RBAC->checkAccess('registered',true);
            $q = $_GET['term'];
            if(isset($q)) {
                 $procedimentos = ProcedimentoAmbulatorial::model()->findAll('nome  like :pesquisa or codigo like :pesquisa',array(':pesquisa'=> '%'.strtoupper(trim($q)).'%'));
 
                if (!empty($procedimentos)) {
                    $out = array();
                    foreach ($procedimentos as $s) {
                            $out[] = array(
                            // expression to give the string for the autoComplete drop-down
                            'label' => $s->NomeCodigo,  
                            'value' => $s->NomeCodigo,
                            'id' => $s->codigo, // return value from autocomplete
                     );
                    }
                echo CJSON::encode($out);
                Yii::app()->end();
           }
       }
   }

    protected function getModelName() {
        return 'ProcedimentoAmbulatorial';
    }
}