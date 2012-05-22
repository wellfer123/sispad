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

      //$this->CheckAcessAction();
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

}
