<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorWebService
 *
 * @author Albuquerque
 */
class MessageWebService {
    //put your code here
    /**
     *@var string
     *@soap
     */
     public $codigo;
     /**
     *@var string
     *@soap   
     */
     public $message;
     
     /**
     *@var string
     *@soap   
     */
     public $tipo;
    
     public function getCodigo() {
         return $this->codigo;
     }

     public function getMessage() {
         return $this->message;
     }

     public function getTipo() {
         return $this->tipo;
     }

     public function setCodigo($codigo) {
         $this->codigo = $codigo;
     }

     public function setMessage($message) {
         $this->message = $message;
     }

     public function setTipo($tipo) {
         $this->tipo = $tipo;
     }


}

?>
