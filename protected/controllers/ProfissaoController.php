<?php

class ProfissaoController extends SISPADBaseController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    protected function getModelName() {
        return 'Profissao';
    }

    public function actionFindProfissoes() {
        $this->_RBAC->checkAccess('registered', true);
        $q = $_GET['term'];
        if (isset($q)) {
            $profissoes = Profissao::model()->findAll('nome like :nome', array(':nome' => strtoupper(trim($q)) . '%'));

            if (!empty($profissoes)) {
                $out = array();
                foreach ($profissoes as $p) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $p->nome,
                        'value' => $p->nome,
                        'id' => $p->codigo, // return value from autocomplete
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }

    public function actionFindProfissoesCbo() {
        $this->_RBAC->checkAccess('registered', true);
        $q = $_GET['term'];
        if (isset($q)) {
            $profissoes = Profissao::model()->findAll('nome  like :pesquisa or codigo like :pesquisa', array(':pesquisa' => '%' . strtoupper(trim($q)) . '%'));

            if (!empty($profissoes)) {
                $out = array();
                foreach ($profissoes as $p) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $p->CboNome,
                        'value' => $p->CboNome,
                        'id' => $p->codigo, // return value from autocomplete
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }

    public function actionFindProfissoesCboSaude() {

        $this->_RBAC->checkAccess('registered', true);
        $q = $_GET['term'];
        if (isset($q)) {
            // CBO iniciado
            $criteria = new CDbCriteria();
            $criteria->condition = " ((SUBSTRING(codigo,1,3)='223' OR SUBSTRING(codigo,1,4)='3222') OR SUBSTRING(codigo,1,4)='3522' OR SUBSTRING(codigo,1,4)='2515' OR codigo='251605') AND (nome  like :pesquisa or codigo like :pesquisa)";
            $criteria->order = " nome";
            $criteria->params = array(':pesquisa' => '%' . strtoupper(trim($q)) . '%');
            $profissoes = Profissao::model()->findAll($criteria);

            if (!empty($profissoes)) {
                $out = array();
                foreach ($profissoes as $p) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $p->CboNome,
                        'value' => $p->CboNome,
                        'id' => $p->codigo, // return value from autocomplete
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }

}
