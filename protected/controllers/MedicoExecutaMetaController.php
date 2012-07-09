<?php

class MedicoExecutaMetaController extends SISPADBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array();
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
//		$model=new MedicoExecutaMeta;
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['MedicoExecutaMeta']))
//		{
//			$model->attributes=$_POST['MedicoExecutaMeta'];
//			if($model->save()){
//                            //$this->redirect(array('MedicoExecutaItem/Create','competencia'=>$model->competencia,'servidor'=>$model->medico_cpf,'cnes'=>$model->unidade_cnes,'meta'=>$model->meta_id));
//				$this->redirect(array('view','id'=>$model->medico_cpf));
//                        }
//		}
//
//		$this->render('create',array(
//			'model'=>$model,
//		));
            $this->redirect(array('send'));
	}
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSend()
	{
		$model=new MedicoExecutaMeta('send');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MedicoExecutaMeta']))
		{
			$model->attributes=$_POST['MedicoExecutaMeta'];
			if($model->validate()){
                            $this->redirect(array('MedicoExecutaItem/Create','competencia'=>$model->competencia,'servidor'=>$model->medico_cpf,'cnes'=>$model->unidade_cnes,'meta'=>$model->meta_id));
				//$this->redirect(array('view','id'=>$model->medico_cpf));
                        }
		}
                $competencias=array();
                
                $comp=Competencia::model()->findAll();
		$this->render('send',array(
			'model'=>$model, 'competencias'=> CHtml::listData(Competencia::model()->findAll(), 'mes_ano', 'mes_ano'),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
//	public function actionUpdate()
//	{
//		$model=$this->loadModel();
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['MedicoExecutaMeta']))
//		{
//			$model->attributes=$_POST['MedicoExecutaMeta'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->medico_cpf));
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//		));
//	}
        
        private function calulaMetas($medicoExecutaMetas){
            if($this->isValidaExecucaoCalculoMetas()){
                try{
                    foreach($medicoExecutaMetas as $meta){
                        //todo o código com try dentro
                        try{
                            //verifica se a meta executa pelo medico existe
                            if(!MedicoExecutaMeta::model()->exists('medico_cpf=:medico AND unidade_cnes=:unidade AND meta_id=:meta AND competencia=:competencia',
                                                                   array(':medico'=>$meta->medico_cpf,':unidade'=>$meta->unidade_cnes,
                                                                          ':meta'=>$meta->meta_id,'competencia'=>$meta>competencia))){
                                //vai salvar a meta, pois não existe
                                if($meta->save()){
                                    Yii::log("Meta salva com sucesso", CLogger::LEVEL_INFO);
                                }
                                else{
                                    Yii::log("Erro ao salvar a meta", CLogger::LEVEL_INFO);
                                }
                                
                            }
                        }catch(Exception $excep){
                          Yii::log("Execução da URL ".$this->route.' no método calculaMetas ao tentar salvar  ameta executada pelo médico ', CLogger::LEVEL_ERROR);  
                        }
                    }
                    
                }catch(Exception $ex){
                        Yii::log("Execução da URL ".$this->route.' no método calculaMetas ao executá-lo', CLogger::LEVEL_ERROR);  
                }
            }
        }
        
        private function isValidaExecucaoCalculoMetas(){
            return true;
        }


        public function actionCalculeMetas(){
            set_time_limit(0);
            try{
                $pageSize=2;
                $offset=0;
                
                $size=$pageSize;
                $metas=array();
                //metas com prodecimentos
                while($size==$pageSize){
                    try{
                        $metas=MedicoExecutaMeta::calculeMetasComProcedimentos(22012, $offset,$pageSize) ;
                        //calcula o tamanho do vetor
                        $size=sizeof($metas);
                        //muda o offset: incrementa
                        $offset+=$pageSize;
                        //vai salvar
                        echo $offset;
                        echo "<br>";
                        $this->calulaMetas($metas);
                    }catch(Exception $e){
                        Yii::log("Execução da URL ".$this->route.' na busca de metas de procedimentos executadas por médicos', CLogger::LEVEL_ERROR);
                    }
                  //enquanto o vetor vier cheio, vai continuar buscando registros
                  }
                  
                //metas com itens
                $offset=0;
                
                $size=$pageSize;
                $metas=array();
                //metas com prodecimentos
                //quando o ultimo vetor devolvido for menor que o tamanho
                //da página vai parar, pois não tem mais itens
                while($size==$pageSize){
                    try{
                        $metas=MedicoExecutaMeta::calculeMetasComItens(22012, $offset,$pageSize) ;
                        //calcula o tamanho do vetor
                        $size=sizeof($metas);
                        //muda o offset: incrementa
                        $offset=$offset+$pageSize;
                        echo $offset;
                        echo "<br>";
                        //vai salvar
                        $this->calulaMetas($metas);
                    }catch(Exception $e){
                        Yii::log("Execução da URL ".$this->route.' no na busca de metas de itens executadas por médicos. '.$e->getMessage(), CLogger::LEVEL_ERROR);
                    }
                  //enquanto o vetor vier cheio, vai continuar buscando registros
                  }
                
            }  catch (Exception $ex){
                Yii::log("Execução da URL ".$this->route.' na action calculeMetas: '.$ex->getMessage(), CLogger::LEVEL_ERROR);
            }
            Yii::app()->end();
        }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
//	public function actionDelete()
//	{
//		if(Yii::app()->request->isPostRequest)
//		{
//			// we only allow deletion via POST request
//			$this->loadModel()->delete();
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_GET['ajax']))
//				$this->redirect(array('index'));
//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new MedicoExecutaMeta('search');
		$model->unsetAttributes();  // clear any default values
		$this->render('index',array(
			'model'=>$model, 'medico'=>$_GET['medico']
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MedicoExecutaMeta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MedicoExecutaMeta']))
			$model->attributes=$_GET['MedicoExecutaMeta'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
         public function actionPreparedAdmin()
        {
                $model= new MedicoExecutaMeta;

                $this->performAjaxValidation($model);
                if(isset($_POST['MedicoExecutaMeta']))
		{
                        
                        $model->competencia= $_POST['MedicoExecutaMeta']['competencia'];

			$this->redirect(array('admin','competencia'=>$model->competencia));
		}else
                    $this->render('prepared_admin',array(
			'model'=>$model,
		));
	}
        
        public function actionRelatorioMetas() {
            $model = new MedicoExecutaMeta;
            $this->widget('application.extensions.phpexcel.EExcelView',
                        array('dataProvider'=>$model->searchMetasExecutadas(null),
                             'title'=>'metasExecutadas_medico',
                             'grid_mode'=>'export',
                             'exportType'=>'Excel2007',
                            ));
            Yii::app()->end();
          

        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=MedicoExecutaMeta::model()->with('medico.servidor','unidade_medico','meta.indicador')->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='medico-executa-meta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    protected function getModelName() {
        return "MedicoExecutaMetaController";
    }
}
