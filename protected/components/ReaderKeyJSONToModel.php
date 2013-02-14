<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReaderKeyJSONToModel
 *
 * @author Albuquerque
 */
class ReaderKeyJSONToModel {

    //put your code here

    public function preencherModeloJSON($arrayJson, $model) {
        //verifica se é um array
        if (is_array($arrayJson)) {
            //verifica se é uma instancia 
            if ($model instanceof JSONModel) {
                $map = $model->getJsonFieldsToModelAttributes();
                //percorre o array associativo
                foreach ($arrayJson as $key => $value) {
                    //caso seja um vetor, faz recursão
                    if (is_array($value)) {
                        $this->preencherModeloJSON($value, $model);
                    } else if (isset($map[$key])) {
                        
                        $atri = $map[$key];
                        //pega objetos alinhados somente em primeiro nível
                        $t = explode('->', $atri);
                        if (count($t) === 2) {
                            //pega uma copia do objeto
                            $at = $model->{$t[0]};
                            $at->{$t[1]} = $value;
                            $model->{$t[0]} = $at;
                        } else {
                            $model->{$atri} = $value;
                        }
                    }
                }
            }
        }
    }

}

?>
