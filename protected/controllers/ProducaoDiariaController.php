<?php
Yii::import('ext.phpexcel.PHPExcel');


class ProducaoDiariaController extends SISPADBaseController {

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
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($u, $e, $d, $p, $g) {
        $this->CheckAcessAction();
        $this->layout = '//layouts/column1';
        $this->render('view', array(
            'model' => $this->loadModel($u, $e, $d, $p, $g),
        ));
    }

    /**
     * Creates a new model.
     * 
     */
    public function actionSend() {
        $this->CheckAcessAction();

        $servidor = $this->getServidor();

        $unidades = $this->getUnidades($servidor);
        if ($unidades != null) {
            //pega pela primeira unidade
            $cnes = $unidades[0]->cnes;
            $especialidades = $this->getEspecialidades($unidades);
            if (!empty($especialidades)) {//verifica se a unidade tem especialidades
                //declaração de variáveis
                $model = new ProducaoDiaria;
                $data = Date('d/m/Y');
                $model->data = $data;

                if (isset($_POST['ProducaoDiaria'])) { //verifica se existe uma requisição post
                    //popula o modelo
                    $model->attributes = $_POST['ProducaoDiaria'];

                    if ($model->validate()) { //valida o modelo
                        $exist = $this->existeProducao($model);
                        if (!$exist) { //verifica se o modelo existe no banco de dados
                            if ($this->existeEspecialidadeUnidadeEProfissional($model)) {//verifica se a quantidade de especialidades da unidade
                                $model->data = ParserDate::inverteDataPtToEn($model->data);
                                if ($model->save()) { //salvou com sucesso, cria um novo modelo
                                    $model = new ProducaoDiaria;
                                    $model->data = $data;
                                    //salvou com sucesso a produção
                                    $this->addMessageSuccess("Produção enviada com sucesso!");
                                }
                                //não salvou
                                else {
                                    $this->addMessageErro("Erro. Não foi possível enviar essa produção!");
                                }
                            } else {
                                $this->addMessageErro("Erro. Você já enviou a produção para a especialidade escolhida!");
                            }
                        } else {//exibe uma mensagem para o usuário
                            $this->addMessageErro("Você já enviou esta produção!");
                        }
                    }
                }
                //coloca os valores que são administrados pelo sistema
                $model->servidor_cpf = $servidor->cpf;
                $model->unidade_cnes = $cnes;
                //pega os profissionais da unidade  
                $profissionais = $this->getProfissionais($cnes, $especialidades[0]->codigo);
                $observacoes = Observacao::model()->findAll();
                //grupo 1 é inválido

                $grupos = $this->getGrupos();
                //renderiza a página
                $this->render('send', array(
                    'model' => $model,
                    'data' => $data,
                    'observacoes' => $observacoes,
                    'unidades' => $unidades,
                    'grupos' => $grupos,
                    'profissionais' => $profissionais,
                    'especialidades' => $especialidades,
                    'servidor' => $servidor,
                ));
                //a unidade não tem especialidades,
                //então o sistema redireciona
            } else {
                $this->redirect(array('profissionalVinculo/create'));
            }
        }
        //o usuário não é gestor de nenhuma unidade
        else {
            throw new CHttpException(404, 'Você não é gestor de nenhuma unidade!');
        }
    }

    public function actionUpdateProducoes() {
        if (Yii::app()->request->isAjaxRequest) {
            
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->CheckAcessAction();
        //pega todas as unidades
        $unidades = CHtml::listData(Unidade::findAllTemGestor(), 'cnes', 'nome');
        $especialidades = CHtml::listData($this->getEspecialidades(), 'codigo', 'nome');

        $model = new ProducaoDiaria('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProducaoDiaria'])) {
            $model->attributes = $_GET['ProducaoDiaria'];
            if ($model->data != null) {
                $model->data = ParserDate::inverteDataPtToEn($model->data);
            }
        }

        $this->render('admin', array(
            'model' => $model,
            'unidades' => $unidades,
            'especialidades' => $especialidades,
        ));
    }

    public function actionFindEspecialidades() {
        if (isset($_POST['unidade'])) {
            $data = CHtml::listData($this->getEspecialidades($_POST['unidade']), 'codigo', 'nome');
            echo "<option value=''>Selecione uma especialidade</option>";
            foreach ($data as $value => $name) {
                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            }
        }
    }

    public function actionFindProfissionais() {

        if (isset($_POST['cnes']) && isset($_POST['cbo'])) {
            $pro = $this->getProfissionais($_POST['cnes'], $_POST['cbo']);
            $data = CHtml::listData($pro, 'cpf', 'servidor.nome');
            //print_r($pro);
            foreach ($data as $value => $name) {

                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            }
        }
    }

    public function actionAdminGestor() {
        $this->CheckAcessAction();
        //pega as unidades que o usuário é gestor
        $unidades = CHtml::listData($this->getUnidades($this->getServidor()), 'cnes', 'nome');
        //pega as especialidades
        $especialidades = CHtml::listData($this->getEspecialidades(), 'codigo', 'nome');

        $model = new ProducaoDiaria('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProducaoDiaria'])) {
            $model->attributes = $_GET['ProducaoDiaria'];
        }
        //filtra pelo servidor logado
        $model->servidor_cpf = Yii::app()->user->cpfservidor;
        $this->render('adminGestor', array(
            'model' => $model,
            'unidades' => $unidades,
            'especialidades' => $especialidades,
        ));
    }

    /**
     * Gerencia todas s produções diárias, inclusive pode excluir.
     * Somente o SuperAdmin tem acesso
     */
    public function actionAdminSuper() {
        //SOMENTE O ADMINISTRADOR DO SISTEMA PODE VISUALIZAR ESTA VIEW
        //$this->_RBAC->checkAccess('admin', true);
        $unidades = CHtml::listData(Unidade::findAllTemGestor(), 'cnes', 'nome');
        $especialidades = CHtml::listData($this->getEspecialidades(), 'codigo', 'nome');

        $model = new ProducaoDiaria('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProducaoDiaria'])) {
            $model->attributes = $_GET['ProducaoDiaria'];
            if ($model->data != null) {
                $model->data = ParserDate::inverteDataPtToEn($model->data);
            }
        }

        $this->render('adminSuper', array(
            'model' => $model,
            'unidades' => $unidades,
            'especialidades' => $especialidades,
        ));
    }

    public function actionMonthEspecialidade() {
        //$this->CheckAcessAction();
        $this->layout = '//layouts/column1';

        $unidades = CHtml::listData(Unidade::findAllTemGestor(), 'cnes', 'nome');

        $model = new ProducaoMensalEspecialidadeModel('search');
        $model->unsetAttributes();
        
        if (isset($_GET['ProducaoMensalEspecialidadeModel'])) {
            $model->attributes = $_GET['ProducaoMensalEspecialidadeModel'];
        }
        //verifica se o parâmetro ano foi passado
        if ($model->ano == null){
            //filtro pelo ano atual
            $model->ano = Date('Y');
        }
        //nome da action que será usada para gerar o relatorio em excel
        $relatorio = 'relatorioMonthEspecialidade';
        $this->render('monthEspecialidade', array('model' => $model, 'unidades' => $unidades, 'anos' => $this->getAnos(),'relatorio'=>$relatorio));
    }

    public function actionMonthGrupo() {
        //$this->CheckAcessAction();
        $this->layout = '//layouts/column1';

        $unidades = CHtml::listData(Unidade::findAllTemGestor(), 'cnes', 'nome');

        $model = new ProducaoMensalGrupoModel('search');
        $model->unsetAttributes();
        
        if (isset($_GET['ProducaoMensalGrupoModel'])) {
            $model->attributes = $_GET['ProducaoMensalGrupoModel'];
        }
        //verifica se o parâmetro ano foi passado
        if ($model->ano == null){
            //filtro pelo ano atual
            $model->ano = Date('Y');
        }
        $relatorio = 'relatorioMonthGrupo';
        $this->render('monthGrupo', array('model' => $model, 'unidades' => $unidades, 'anos' => $this->getAnos(),'relatorio'=>$relatorio));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ProducaoDiaria the loaded model
     * @throws CHttpException
     */
    public function loadModel($u, $e, $d, $p, $g) {
        $model = ProducaoDiaria::model()->with(array('gestor', 'profissional', 'grupo', 'unidade'))->findByPk(array(
            'unidade_cnes' => $u,
            'profissao_codigo' => $e,
            'data' => $d,
            'profissional_cpf' => $p,
            'grupo_codigo' => $g,
        ));
        if ($model === null)
            throw new CHttpException(404, 'A página requisitada não existe!');
        return $model;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($e, $d, $u, $p, $g) {
        //SOMENTE UM ADMINISTRADOR DO SISTEMA PODE DELETAR UMA PRODUÇÃO
        $this->_RBAC->checkAccess('admin', true);
        $this->loadModel($u, $e, $d, $p, $g)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Performs the AJAX validation.
     * @param ProducaoDiaria $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'producao-diaria-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @param mixed $unidade pode ser um cnes de uma unidade ou um array com Unidades
     * @return array map com o código e descrição de cada especialidade que tem um grupo
     */
    private function getEspecialidades($unidade = null) {

        $criteria = new CDbCriteria();
        $criteria->alias = 'prof';
        $criteria->order = ' prof.nome ';
        $criteria->join = "INNER JOIN profissional_vinculo pv ON pv.codigo_profissao=prof.codigo";
        if ($unidade != null) {
            //verifica se é um array
            if (is_array($unidade)) {
                $cond = ' pv.unidade_cnes IN (';
                $cont = 0;
                //lista de CNES
                foreach ($unidade as $key => $unidade) {
                    $cnes = $unidade->cnes;
                    if ($cont > 0) {
                        $cond = $cond . ", $cnes";
                    } else {
                        $cond = $cond . " $cnes";
                    }
                    $cont = 1;
                }
                $cond = $cond . ")";
                $criteria->condition = $cond;
            } else {
                $criteria->condition = ' pv.unidade_cnes=:cnes';
                $criteria->params = array(':cnes' => $unidade);
            }
        } else {
            $criteria->distinct = true;
        }

        $models = Profissao::model()->findAll($criteria); //' grupo_codigo IS NOT NULL AND grupo_codigo <> 0');
        return $models;
    }

    public function getProfissionais($cnes, $cbo = null) {
        //pega os profissionais da unidade  
        $criteria = new CDbCriteria();

        $criteria->alias = 'pv';
        $params = array(':cnes' => $cnes, ':status' => ProfissionalVinculo::ATIVO);
        if ($cbo != null) {
            $params[':cbo'] = $cbo;
            $criteria->condition = 'pv.ativo=:status AND pv.unidade_cnes=:cnes AND pv.codigo_profissao=:cbo';
        } else {
            $criteria->condition = 'pv.ativo=:status AND pv.unidade_cnes=:cnes';
        }
        $criteria->params = $params;
        $criteria->order = 'servidor.nome';
        //pega os dados para preencher o combobox
        return $profi = ProfissionalVinculo::model()->with('servidor')->findAll($criteria);
    }

    /**
     * 
     * @param ProducaoDiaria $model
     * @return boolean true se o modelo pasado já foi enviado e false caso conttrário
     */
    private function existeProducao($model) {
        //verifica pela chave primária
        $criteria = new CDbCriteria();
        $criteria->condition = 'profissao_codigo=:prof AND unidade_cnes=:cnes AND profissional_cpf=:cpf AND data=:data AND grupo_codigo=:grupo';
        $criteria->params = array(
            ':prof' => $model->profissao_codigo,
            ':cnes' => $model->unidade_cnes,
            ':grupo' => $model->grupo_codigo,
            ':data' => ParserDate::inverteDataPtToEn($model->data),
            ':cpf' => $model->profissional_cpf);
        return ProducaoDiaria::model()->exists($criteria);
    }

    /**
     * Verifica se a quantidade
     * @param Producaodiaria $model
     */
    private function existeEspecialidadeUnidadeEProfissional($model) {
        $profiVinc = ProfissionalVinculo::model()->find('unidade_cnes=:cnes AND codigo_profissao=:codigo AND cpf=:cpf', array(
            ':cnes' => $model->unidade_cnes,
            ':codigo' => $model->profissao_codigo,
            ':cpf' => $model->profissional_cpf,
        ));
        return $profiVinc != null ? count($profiVinc) > 0 : false;
    }

    /**
     * 
     * @param Servidor $servidor
     * @return array com todas as unidades que o servidor passado como parâmetro é gestor
     */
    public function getUnidades($servidor) {
        if ($servidor instanceof Servidor) {
            return Unidade::findAllPorGestor($servidor);
        }
        return null;
    }

    /**
     * 
     * @return type
     */
    private function getGrupos() {
        $criteria = new CDbCriteria();

        $criteria->alias = 'g';
        $criteria->order = 'g.nome';
        $criteria->condition = 'g.codigo <> 1';
        return Grupo::model()->findAll($criteria);
    }

    private function getAnos(){
        return array('2013'=>'2013');
    }

    protected function getModelName() {
        return 'ProducaoDiaria';
    }
    
    
    public function actionRelatorioMonthGrupo() {
       $model = new ProducaoMensalGrupoModel('search');
       $model->unsetAttributes();
        
        if (isset($_GET['ProducaoMensalGrupoModel'])) {
            $model->attributes = $_GET['ProducaoMensalGrupoModel'];
        }
        //verifica se o parâmetro ano foi passado
        if ($model->ano == null){
            //filtro pelo ano atual
            $model->ano = Date('Y');
        }
        
        
        
        $columns = array(
            array(
                'name' => 'grupo',
                'header' => 'Grupo',
               
            ),
            array(
                'name' => 'jan',
                'header' => 'Jan',
            ),
            array(
                'name' => 'fev',
                'header' => 'Fev',
            ),
            array(
                'name' => 'mar',
                'header' => 'Mar',
            ),
            array(
                'name' => 'abr',
                'header' => 'Abr',
            ),
            array(
                'name' => 'mai',
                'header' => 'Mai',
            ),
            array(
                'name' => 'jun',
                'header' => 'Jun',
            ),
            array(
                'name' => 'jul',
                'header' => 'Jul',
            ),
            array(
                'name' => 'ago',
                'header' => 'Ago',
            ),
            array(
                'name' => 'set',
                'header' => 'Set',
            ),
            array(
                'name' => 'out',
                'header' => 'Out',
            ),
            array(
                'name' => 'nov',
                'header' => 'Nov',
            ),
            array(
                'name' => 'dez',
                'header' => 'Dez',
            ),
            array(
                'name' => 'anual',
                'header' => 'Anual',
            ),
        );
        
        $this->widget('application.extensions.phpexcel.EExcelView', array('dataProvider' => $model->search(),
            'title' => 'grupos'.date('Y-m-d h:i:s'),
            'grid_mode' => 'export',
            'exportType' => 'Excel2007',
            'columns'=>$columns,
        ));
        Yii::app()->end();
    }    
    
    
    public function actionRelatorioMonthEspecialidade() {
        $model = new ProducaoMensalEspecialidadeModel('search');
        $model->unsetAttributes();
        
        if (isset($_GET['ProducaoMensalEspecialidadeModel'])) {
            $model->attributes = $_GET['ProducaoMensalEspecialidadeModel'];
        }
        //verifica se o parâmetro ano foi passado
        if ($model->ano == null){
            //filtro pelo ano atual
            $model->ano = Date('Y');
        }
        
         $columns = array(
            array(
                'name' => 'especialidade',
                'header' => 'Especialidade',
               
            ),
            array(
                'name' => 'jan',
                'header' => 'Jan',
            ),
            array(
                'name' => 'fev',
                'header' => 'Fev',
            ),
            array(
                'name' => 'mar',
                'header' => 'Mar',
            ),
            array(
                'name' => 'abr',
                'header' => 'Abr',
            ),
            array(
                'name' => 'mai',
                'header' => 'Mai',
            ),
            array(
                'name' => 'jun',
                'header' => 'Jun',
            ),
            array(
                'name' => 'jul',
                'header' => 'Jul',
            ),
            array(
                'name' => 'ago',
                'header' => 'Ago',
            ),
            array(
                'name' => 'set',
                'header' => 'Set',
            ),
            array(
                'name' => 'out',
                'header' => 'Out',
            ),
            array(
                'name' => 'nov',
                'header' => 'Nov',
            ),
            array(
                'name' => 'dez',
                'header' => 'Dez',
            ),
            array(
                'name' => 'anual',
                'header' => 'Anual',
            ),
        );
        
        
        $this->widget('application.extensions.phpexcel.EExcelView', array('dataProvider' => $model->search(),
            'title' => 'especialidades'.date('Y-m-d h:i:s'),
            'grid_mode' => 'export',
            'exportType' => 'Excel2007',
            'columns'=>$columns,
        ));
        Yii::app()->end();
    }    
    
    
  

}
