<?php

class EnfermeiroExecutaMetaController extends Controller
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
            return array(array('allow',  // deny all users
				'users'=>array('*'),
			),);
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
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
		
                $this->redirect(array('send'));
	}
        
         
         public function actionSend()
	{
		$model=new EnfermeiroExecutaMeta('send');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EnfermeiroExecutaMeta']))
		{
			$model->attributes=$_POST['EnfermeiroExecutaMeta'];
                        $model->competencia=$_POST['EnfermeiroExecutaMeta']['competencia'];
			if($model->validate()){
                            $this->redirect(array('EnfermeiroExecutaItem/Create','competencia'=>$model->competencia,'servidor'=>$model->enfermeiro_cpf,'cnes'=>$model->unidade_cnes,'meta'=>$model->meta_id));
				//$this->redirect(array('view','id'=>$model->medico_cpf));
                        }
		}
                $competencias=array();
                
                $comp=Competencia::model()->findAll();
		$this->render('send',array(
			'model'=>$model, 'competencias'=> CHtml::listData(Competencia::model()->findAll(), 'mes_ano', 'mes_ano'),
		));
	}
        
         private function calulaMetas($enfermeiroExecutaMetas){
            if($this->isValidaExecucaoCalculoMetas()){
                try{
                    foreach($enfermeiroExecutaMetas as $meta){
                        //todo o código com try dentro
                        try{
                            //verifica se a meta executa pelo Enfermeiro existe
                            if(!EnfermeiroExecutaMeta::model()->exists('enfermeiro_cpf=:enfermeiro AND unidade_cnes=:unidade AND meta_id=:meta AND competencia=:competencia',
                                                                   array(':enfermeiro'=>$meta->enfermeiro_cpf,':unidade'=>$meta->unidade_cnes,
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
                        $metas=EnfermeiroExecutaMeta::calculeMetasComProcedimentos(22012, $offset,$pageSize) ;
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
                        $metas=EnfermeiroExecutaMeta::calculeMetasComItens(22012, $offset,$pageSize) ;
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
        
         //retorna um array com as competencias
         public function listaCompetencias() {
            $model = new EnfermeiroExecutaMeta;
            return $model->listaCompetencias();
         }
         
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EnfermeiroExecutaMeta']))
		{
			$model->attributes=$_POST['EnfermeiroExecutaMeta'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->enfermeiro_cpf));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EnfermeiroExecutaMeta');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EnfermeiroExecutaMeta('search');
		$model->unsetAttributes();  // clear any default values
                //seta a competencia
                if(isset($_GET['competencia'])){
                     $model->competencia=$_GET['competencia'];
                }
		if(isset($_GET['EnfermeiroExecutaMeta']))
			$model->attributes=$_GET['EnfermeiroExecutaMeta'];
                        //$model->competencia=$_GET['EnfermeiroExecutaMeta']['competencia'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionRelatorioMetas($competencia) {
            $model = new EnfermeiroExecutaMeta;
            $this->widget('application.extensions.phpexcel.EExcelView',
                        array('dataProvider'=>$model->searchMetasExecutadas($competencia),
                             'title'=>'metasExecutadas_enfermeiro_'.$competencia,
                             'grid_mode'=>'export',
                             'exportType'=>'Excel2007',
                            ));
            Yii::app()->end();
          

        }
        
         public function actionPreparedAdmin()
        {
                $model= new EnfermeiroExecutaMeta;

                $this->performAjaxValidation($model);
                if(isset($_POST['EnfermeiroExecutaMeta']))
		{
                        
                        $model->competencia= $_POST['EnfermeiroExecutaMeta']['competencia'];

			$this->redirect(array('admin','competencia'=>$model->competencia));
		}else
                    $this->render('prepared_admin',array(
			'model'=>$model,
		));
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
				$this->_model=EnfermeiroExecutaMeta::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='enfermeiro-executa-meta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
