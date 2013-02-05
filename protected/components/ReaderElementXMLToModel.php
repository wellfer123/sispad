<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReaderElementXMLToModel
 *
 * @author Albuquerque
 */
class ReaderElementXMLToModel {
    //put your code here

    /**
     *
     * @param Element $elemento um elemento XML que contenhas outros elementos, ou seja,
     * cada filho desse elemento corresponde a um atributo do modelXML
     * @param XMLModel $modelXML um objeto que seja instancia de ModelXML
     * @return void Somente preenche o objeto 
     */
    public function preencherModeloXML($elemento, $modelXML) {
        if ($modelXML instanceof XMLModel) {
            //caso base para recursividade
            if (!is_object($elemento)) {
                return;
            }
            //pega os elementos filhos
            $children = $elemento->children();
            //verifica sem tem filhos
            if (count($children) > 0) {
                //pega os atributos para mapear
                $vet = $modelXML->getFileFieldsToModelAttributes();
                //percorre o filhos que sao as propriedades do objeto
                foreach ($children as $no => $value) {
                    try {
                        //verifica se esse no tem outros
                        $size = count($value);
                        if ($size > 0) {
                            //recursividade
                            $this->preencherModeloXML($value, $modelXML);
                        } else {
                            $atributo = $vet[$no];
                            if ($atributo != null) {
                                //quebra o atributo, caso esse seja um objeto.
                                $t = explode('->', $atributo);
                                if (count($t) === 2) {
                                    $at = $modelXML->{$t[0]};
                                    $at->{$t[1]} = $elemento->{$no};
                                    $modelXML->{$t[0]} = $at;
                                } else {
                                    $modelXML->{$atributo} = $elemento->{$no};
                                }
                            }
                        }
                        //execeções que podem ocorrer
                        //atributo não encontrado no modelo
                    } catch (Exception $ex) {
                        Yii::log($ex, CLogger::LEVEL_ERROR);
                    }
                }
            }
        }
    }

}

?>
