<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Albuquerque
 */
interface XMLModel {
    //put your code here
    
    /**
     * @return array onde  a chave é o campo no arquivo e o valor
     * o atributo do modelo ou objeto.
     */
    public function getFileFieldsToModelAttributes();
}

?>
