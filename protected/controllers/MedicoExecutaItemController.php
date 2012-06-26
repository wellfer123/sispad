<?php

class MedicoExecutaItemController extends SISPADBaseController
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
		return array(
		);
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
		$model=new MedicoExecutaItem('valTemp');
                $modelos=array();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                //pegar os parâmetros necessários
                if(isset($_GET['competencia'])){
                    //verifica se a competencia existe mesmo
                    if(Competencia::model()->exists('mes_ano=:comp',array(':comp'=>$_GET['competencia']))){
                        $model->competencia=$_GET['competencia'];
                    }
                }
                //verifica se o paramentro servidor e cnes existem, depois pega o medico
                if(isset($_GET['servidor'])&& isset($_GET['cnes'])){
                    if(Medico::model()->exists('servidor_cpf=:cpf AND unidade_cnes=:unidade', 
                                    array(':cpf'=>$_GET['servidor'],':unidade'=>$_GET['cnes']))){
                        
                    $model->medico_cpf=$_GET['servidor'];
                    $model->medico_unidade_cnes=$_GET['cnes'];
                    }
                }
                //caso os parâmetros não sejam válidos vai exibir o erro!
                $model->validate();
                //fim dos parâmetros necessários
                //para ada item a ser enviado vai gerar um modelo
                $itens=Item::model()->findAll('meta_id=:meta',array(':meta'=>$_GET['meta']));
                //verifica se o vetor está vazio
                if(empty($itens)){
                    $this->addMessageErro("Não existe nenhum item a ser enviado para essa meta!");
                }
                foreach ($itens as $iten){
                    $m= new MedicoExecutaItem('create');
                    $m->medico_unidade_cnes=$model->medico_unidade_cnes;
                    $m->medico_cpf=$model->medico_cpf;
                    $m->competencia=$model->competencia;
                    $modelos[]=$m;
                }
                
		if(isset($_POST['MedicoExecutaItem']))
		{
                        $valide=true;
                        foreach ($modelos as $i=>$mod){
                            if(isset($_POST['MedicoExecutaItem'])){
                                $mod->attributes=$_POST['MedicoExecutaItem'][$i];
                                $valide=$valide && $mod->validate();
                            }
                        }
                        //se todos os modelos são válidos
                        if($valide){
                            //percorre o vetor de modelos e salva no banco de dados
                            foreach ($modelos as $i=>$mode){
                                //verifica se já existe
                                $exi=MedicoExecutaItem::model()->exists('medico_cpf=:medico AND medico_unidade_cnes=:unidade AND item_id=:item AND competencia=:competencia',
                                                                        array(':medico'=>$mode->medico_cpf,':unidade'=>$mode->medico_unidade_cnes,
                                                                          ':item'=>$mode->item_id,':competencia'=>$mode->competencia));
                                //não existe, então salva
                                $nome=$itens[$i]->nome;
                                if(!$exi){
                                    //se conseguir salvar com sucesso mostra mensagem de sucesso
                                    if($mode->save()){
                                        $this->addMessageSuccess("Item $nome enviado com sucesso");
                                    }
                                    else{
                                        $this->addMessageErro("Falha ao enviar o item $nome.");
                                    }
                                }
                                else{
                                    $this->addMessageErro("Item já foi enviado!");
                                }
                            }
                            $this->redirect(array('list','servidor'=>$model->medico_cpf,'unidade'=>$model->medico_unidade_cnes,'meta'=>$_GET['meta'],'competencia'=>$model->competencia));
                        }
                        else{
                            $this->addMessageErro('Existem itens inválidos!');
                        }
//			if($model->save())
				//$this->redirect(array('admin','id'=>$model->medico_cpf));
		}
                //vai pegar o médico
                $medico=  Medico::model()->with('servidor','unidade')->find('t.servidor_cpf=:cpf AND t.unidade_cnes=:unidade',
                                                                            array(':cpf'=>$model->medico_cpf,'unidade'=>$model->medico_unidade_cnes));
                
                
		$this->render('create',array('model'=>$model,'modelos'=>$modelos,'itens'=>$itens,'competencia'=>$_GET['competencia'],'medico'=>$medico));
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
//		if(isset($_POST['MedicoExecutaItem']))
//		{
//			$model->attributes=$_POST['MedicoExecutaItem'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->medico_cpf));
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//		));
//	}

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
	public function actionList()
	{
		$model=new MedicoExecutaItem('search');
                $model->unsetAttributes();
                if(isset($_GET['servidor']) ){
                    $model->medico_cpf=$_GET['servidor'];
                }
                if(isset($_GET['unidade'])){
                    $model->medico_unidade_cnes=$_GET['unidade'];
                }
		$this->render('list',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MedicoExecutaItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MedicoExecutaItem']))
			$model->attributes=$_GET['MedicoExecutaItem'];

		$this->render('admin',array(
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
			if(isset($_GET['servidor']) && isset($_GET['item']) && isset($_GET['unidade']) && isset($_GET['competencia']) )
                            //pega o modelo pela chave primária composta
				$this->_model=MedicoExecutaItem::model()->with('medico.servidor','unidade','item.meta')->findByPk(array(
                                                                          'item_id'=>$_GET['item'],'medico_unidade_cnes'=>$_GET['unidade'],
                                                                          'competencia'=>$_GET['competencia'],'medico_cpf'=>$_GET['servidor']));
			if($this->_model===null)
				throw new CHttpException(404,'A página requisitada não existe!');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='medico-executa-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        protected function getModelName() {
        return "MedicoExecutaItem";
    }
}
