<?php

class AgenteSaudeExecutaItemController extends SISPADBaseController
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','list','admin'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
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
		$model=new AgenteSaudeExecutaItem('valTemp');
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
                //verifica se o paramentro servidor e cnes existem, depois pega o AgenteSaude
                if(isset($_GET['servidor'])&& isset($_GET['cnes'])){
                    if(AgenteSaude::model()->exists('servidor_cpf=:cpf AND unidade_cnes=:unidade', 
                                    array(':cpf'=>$_GET['servidor'],':unidade'=>$_GET['cnes']))){
                        
                    $model->agente_saude_cpf=$_GET['servidor'];
                    $model->agente_saude_unidade_cnes=$_GET['cnes'];
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
                    $m= new AgenteSaudeExecutaItem('create');
                    $m->agente_saude_unidade_cnes=$model->agente_saude_unidade_cnes;
                    $m->agente_saude_cpf=$model->agente_saude_cpf;
                    $m->competencia=$model->competencia;
                    $modelos[]=$m;
                }
                
		if(isset($_POST['AgenteSaudeExecutaItem']))
		{
                        $valide=true;
                        foreach ($modelos as $i=>$mod){
                            if(isset($_POST['AgenteSaudeExecutaItem'])){
                                $mod->attributes=$_POST['AgenteSaudeExecutaItem'][$i];
                                $valide=$valide && $mod->validate();
                            }
                        }
                        //se todos os modelos são válidos
                        if($valide){
                            //percorre o vetor de modelos e salva no banco de dados
                            foreach ($modelos as $i=>$mode){
                                //verifica se já existe
                                $exi=AgenteSaudeExecutaItem::model()->exists('agente_saude_cpf=:agente_saude AND agente_saude_unidade_cnes=:unidade AND item_id=:item AND competencia=:competencia',
                                                                        array(':agente_saude'=>$mode->agente_saude_cpf,':unidade'=>$mode->agente_saude_unidade_cnes,
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
                            $this->redirect(array('list','servidor'=>$model->agente_saude_cpf,'unidade'=>$model->agente_saude_unidade_cnes,'meta'=>$_GET['meta'],'competencia'=>$model->competencia));
                        }
                        else{
                            $this->addMessageErro('Existem itens inválidos!');
                        }
//			if($model->save())
				//$this->redirect(array('admin','id'=>$model->agente_saude_cpf));
		}
                //vai pegar o AgenteSaude
                $agenteSaude=  AgenteSaude::model()->with('servidor','unidade')->find('t.servidor_cpf=:cpf AND t.unidade_cnes=:unidade',
                                                                            array(':cpf'=>$model->agente_saude_cpf,'unidade'=>$model->agente_saude_unidade_cnes));
           
                
		$this->render('create',array('model'=>$model,'modelos'=>$modelos,'itens'=>$itens,'competencia'=>$_GET['competencia'],'agenteSaude'=>$agenteSaude));
	}

        
          public function actionList()
	{
		$model=new AgenteSaudeExecutaItem('search');
                $model->unsetAttributes();
                if(isset($_GET['servidor']) ){
                    $model->agente_saude_cpf=$_GET['servidor'];
                }
                if(isset($_GET['unidade'])){
                    $model->agente_saude_unidade_cnes=$_GET['unidade'];
                }
		$this->render('list',array(
			'model'=>$model,
		));
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

		if(isset($_POST['AgenteSaudeExecutaItem']))
		{
			$model->attributes=$_POST['AgenteSaudeExecutaItem'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->agente_saude_cpf));
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
		$dataProvider=new CActiveDataProvider('AgenteSaudeExecutaItem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AgenteSaudeExecutaItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AgenteSaudeExecutaItem']))
			$model->attributes=$_GET['AgenteSaudeExecutaItem'];

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
				$this->_model=AgenteSaudeExecutaItem::model()->with('agente_saude.servidor','unidade','item.meta')->findByPk(array(
                                                                          'item_id'=>$_GET['item'],'agente_saude_unidade_cnes'=>$_GET['unidade'],
                                                                          'competencia'=>$_GET['competencia'],'agente_saude_cpf'=>$_GET['servidor']));
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='agente-saude-executa-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    protected function getModelName() {
        return 'AgenteSaudeExecutaItem';
    }
}
