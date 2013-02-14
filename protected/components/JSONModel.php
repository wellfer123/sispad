<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Albuquerque
 */
interface JSONModel {
    //put your code here
    
    /**
     * Retorna um vetor associativo onde a chave refere-se
     * à chave no objeto json e o valor ao atributo do objeto
     */
    public function getJsonFieldsToModelAttributes();
}

?>
